<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
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
        $totalRevenue        = DB::table('orders')->sum('total_cost');
        $totalUsers          = DB::table('users')->count();
        $averageOrderValue   = DB::table('orders')->avg('total_cost');
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
        $users         = User::where('userType', '!=', 'admin')
         ->paginate(10)->appends(['tab' => 'allUsers']);
        $orders        = Order::paginate(10)->appends(['tab' => 'allOrders']);
        $allcategories = Category::paginate(5)->appends(['tab' => 'allProducts']);


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
            'allcategories'
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
        $allcategories = Category::paginate(5)->appends(['tab' => 'allProducts']);
        $users         = User::where('userType','!=','admin')->paginate(10)->appends(['tab' => 'allUsers']);

        return view('admin.dashboard', compact(
            'orders',
            'search',
            'allcategories',
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
        $allcategories = Category::paginate(5)->appends(['tab' => 'allProducts']);

        return view('admin.dashboard', compact(
            'admin',
            'users',
            'search',
            'orders',
            'allcategories',
            'totalOrders',
            'totalRevenue',
            'totalUsers',
            'averageOrderValue',
            'bestSellers',
            'lowStockProducts'
        ))->with('tab', 'allUsers');
    }
}
