<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    /**
     * Show the admin dashboard.
     */
    public function index()
    {
        $admin = Auth::user();

        // Admin Dashboard KPI's
        $totalOrders         = DB::table('orders')->count();
        $totalRevenue        = DB::table('orders')
        ->whereIn('status', ['Processed/Shipped']) // Exclude "Paid" Orders
        ->sum('total_cost');
        $totalUsers          = DB::table('users')->count();
        $averageOrderValue   = DB::table('orders')
        ->whereIn('status', ['Processed/Shipped']) // Exclude "Paid" Orders
        ->avg('total_cost');
        $bestSellers = DB::table('order_item')
            ->join('products', 'order_item.product_id', '=', 'products.id')
            ->join('orders', 'order_item.order_id', '=', 'orders.id') 
            ->whereIn('orders.status', ['Processed/Shipped']) 
            ->select(
                'products.id',
                'products.name',
                'products.size',   
                'products.image', 
                DB::raw('SUM(order_item.quantity) as total_sold')
            )
            ->groupBy(
                'products.id',
                'products.name',
                'products.size',
                'products.image'
            )
            ->orderByDesc('total_sold')
            ->limit(5)
            ->get();
         $lowStockProducts = DB::table('products')
            ->where('stock', '<=', 10)
            ->orderBy('stock', 'asc')
            ->limit(5)
            ->get();
        $users         = User::where('userType', '!=', 'admin')
         ->paginate(10)->appends(['tab' => 'allUsers']);
        $orders        = Order::paginate(10)->appends(['tab' => 'allOrders']);
        $allcategories = Category::paginate(5)->appends(['tab' => 'allCategories']);
        $allproducts = Product::paginate(5)->appends(['tab' => 'allProducts']);


        // Pass everything to admin dashboard view
        return view('admin.dashboard', compact(
            'admin',
            'totalOrders',
            'totalRevenue',
            'totalUsers',
            'averageOrderValue',
            'bestSellers',
            'lowStockProducts',
            'users',
            'orders',
            'allcategories',
            'allproducts'
        ));
    }

    public function orders(Request $request)
    {
        $admin = Auth::user();

        $search = $request->input('search');
        

        // Filter orders based on the search. Example:
        $orders = Order::with('user','orderItems.product')
                       ->where('id', 'LIKE', "%{$search}%")
                       ->orWhereHas('user', function($q) use ($search) {
                           $q->where('firstName', 'LIKE', "%{$search}%")
                             ->orWhere('email', 'LIKE', "%{$search}%");
                       })
                       ->paginate(10)
                       ->appends(['search' => $search, 'tab' => 'allOrders']);

        // Re-fetch Admin Dashboard KPI's
        $totalOrders       = Order::count();
        $totalRevenue      = Order::sum('total_cost');
        $totalUsers        = User::count();
        $averageOrderValue = Order::avg('total_cost');
        $bestSellers = DB::table('order_item')
            ->join('products', 'order_item.product_id', '=', 'products.id')
            ->select(
                'products.id',
                'products.name',
                'products.size',   
                'products.image', 
                DB::raw('SUM(order_item.quantity) as total_sold')
            )
            ->groupBy(
                'products.id',
                'products.name',
                'products.size',
                'products.image'
            )
            ->orderByDesc('total_sold')
            ->limit(5)
            ->get();
        $lowStockProducts = DB::table('products')
            ->where('stock', '<=', 10)
            ->orderBy('stock', 'asc')
            ->limit(5)
            ->get();
        $allcategories = Category::paginate(5)->appends(['tab' => 'allCategories']);
        $allproducts = Product::paginate(5)->appends(['tab' => 'allProducts']);
        $users         = User::where('userType','!=','admin')->paginate(10)->appends(['tab' => 'allUsers']);

        return view('admin.dashboard', compact(
            'orders',
            'search',
            'allcategories',
            'allproducts',
            'admin',
            'users',
            'totalOrders',
            'totalRevenue',
            'totalUsers',
            'averageOrderValue',
            'bestSellers',
            'lowStockProducts'
        ))->with('tab', 'allOrders');
    }

    public function update(Request $request, Order $order) 
    {
        $request->validate(['status' => 'required|in:Paid,Processed/Shipped,Returned,Cancelled']);

        // Define allowed status trasititons
        $validTransitions = [
            'Paid' => ['Processed/Shipped', 'Cancelled'],
            'Processed/Shipped' => ['Returned'],
            'Returned' => [], 
            'Cancelled' => [] 
        ];

        // Check if the requested transition is allowed
        if (!in_array($request->status, $validTransitions[$order->status] ?? [])) {
            return back()->with('error', 'Invalid status change.');
        }

        // If changing status to "Processed/Shipped" decrease stock 
        if ($order->status === 'Paid' && $request->status === 'Processed/Shipped') {
            foreach ($order->orderItems as $item) {
                $product = $item->product; 
                if ($product->stock >= $item->quantity) {
                    $product->decrement('stock', $item->quantity);
                } else {
                    return back()->with('error', 'Not enough stock for ' . $product->name);
                }
            }
        }

        // If changing status to "Returned" add stock back 
        if ($order->status === 'Processed/Shipped' && $request->status === 'Returned') {
            foreach ($order->orderItems as $item) {
                $product = $item->product; 
                $product->increment('stock', $item->quantity);
            }

             // Keep order total the same, just update status
             DB::table('orders')
             ->where('id', $order->id)
             ->update(['total_cost' => 0]);
    
        }

        // If changing status to "Cancelled" remove the order items 
        if ($request->status === 'Cancelled') {
            $order->orderItems()->delete(); // Delete order items first
            $order->delete(); // Delete the order itself 
            return back()->with('success', 'Order cancelled and removed.');
        }

        // Update order status
        $order->update(['status' => $request->status]);
        return back()->with('success', 'Order status updated successfully');
    }

    /**
     * Search users.
     */
    public function users(Request $request)
    {
        $admin = Auth::user();

        $search = $request->input('search');

        // Filter users based on the search
        $users = User::where('userType','!=','admin')
                    ->where(function($q) use ($search) {
                        $q->where('firstName', 'LIKE', "%{$search}%")
                          ->orWhere('email', 'LIKE', "%{$search}%");
                    })
                    ->paginate(10)
                    ->appends(['search' => $search, 'tab' => 'allUsers']);

        // Re-fetch KPI data
        $totalOrders       = Order::count();
        $totalRevenue      = Order::sum('total_cost');
        $totalUsers        = User::count();
        $averageOrderValue = Order::avg('total_cost');
        $bestSellers = DB::table('order_item')
            ->join('products', 'order_item.product_id', '=', 'products.id')
            ->select(
                'products.id',
                'products.name',
                'products.size',   
                'products.image',  
                DB::raw('SUM(order_item.quantity) as total_sold')
            )
            ->groupBy(
                'products.id',
                'products.name',
                'products.size',
                'products.image'
            )
            ->orderByDesc('total_sold')
            ->limit(5)
            ->get();
        $lowStockProducts = DB::table('products')
            ->where('stock', '<=', 10)
            ->orderBy('stock', 'asc')
            ->limit(5)
            ->get();
        $orders        = Order::with('user','orderItems.product')->paginate(10)->appends(['tab' => 'allOrders']);
        $allcategories = Category::paginate(5)->appends(['tab' => 'allCategories']);
        $allproducts = Product::paginate(5)->appends(['tab' => 'allProducts']);

        return view('admin.dashboard', compact(
            'admin',
            'users',
            'search',
            'orders',
            'allcategories',
            'allproducts',
            'totalOrders',
            'totalRevenue',
            'totalUsers',
            'averageOrderValue',
            'bestSellers',
            'lowStockProducts'
        ))->with('tab', 'allUsers');
    }

    public function search(Request $request)
    {
        $admin = Auth::user();

        $search = $request->input('search');

        // Filter users based on the search
        $users = User::where('userType','!=','admin')
                    ->where(function($q) use ($search) {
                        $q->where('firstName', 'LIKE', "%{$search}%")
                          ->orWhere('email', 'LIKE', "%{$search}%");
                    })
                    ->paginate(10)
                    ->appends(['search' => $search, 'tab' => 'allUsers']);

        // Re-fetch KPI data
        $totalOrders       = Order::count();
        $totalRevenue      = Order::sum('total_cost');
        $totalUsers        = User::count();
        $averageOrderValue = Order::avg('total_cost');
        $bestSellers = DB::table('order_item')
            ->join('products', 'order_item.product_id', '=', 'products.id')
            ->select(
                'products.id',
                'products.name',
                'products.size',   
                'products.image',  
                DB::raw('SUM(order_item.quantity) as total_sold')
            )
            ->groupBy(
                'products.id',
                'products.name',
                'products.size',
                'products.image'
            )
            ->orderByDesc('total_sold')
            ->limit(5)
            ->get();
        $lowStockProducts = DB::table('products')
            ->where('stock', '<=', 10)
            ->orderBy('stock', 'asc')
            ->limit(5)
            ->get();
        $orders        = Order::with('user','orderItems.product')->paginate(10)->appends(['tab' => 'allOrders']);
        $allcategories = Category::paginate(5)->appends(['tab' => 'allCategories']);

        $search = $request->input('search');

        $query = Product::query();

        // Filter by product name or category name
        if (!empty($search)) {
            $query->where('name', 'like', '%' . $search . '%')
                  ->orWhereHas('category', function ($q) use ($search) {
                      $q->where('name', 'like', '%' . $search . '%');
                  });
        }

        // Retrieve the matching products
        $allproducts = $query->paginate(5);

        
        return view('admin.dashboard', compact(
            'admin',
            'users',
            'search',
            'orders',
            'allcategories',
            'allproducts',
            'totalOrders',
            'totalRevenue',
            'totalUsers',
            'averageOrderValue',
            'bestSellers',
            'lowStockProducts'
        ))->with('tab', 'allProducts');
    }

    public function edit(User $user)
    {
        return view('edit-user', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName'  => 'required|string|max:255',
            'email'     => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone'     => 'nullable|string|max:20',
        ]);

        $user->update($request->only('firstName', 'lastName', 'email', 'phone'));

        return redirect()->route('admin.dashboard', ['tab' => 'allUsers'])->with('success', 'User updated successfully.');
    }

}
