<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Delivery;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; 

class CheckoutController extends Controller
{
    public function index()
    {
        // displays the checkout page view
        return view('checkout'); 
    }

    public function add(Request $request)
    {
        //Checks that the details entered by the user isn't empty
        $request -> validate([
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postcode' => 'required|string|max:255',
        ]);

        //Gets the items from the user's basket
        $basket_Items = Cart::where('user_id', Auth::id())->get();

        //Creates a transaction
        $result = DB::transaction(function () use ($request, $basket_Items) {
            //Creates the delivery address entry
            $delivery = Delivery::create([
                'address' => $request->address,
                'city' => $request->city,
                'postcode' => $request->postcode,
                'user_id' => Auth::id(),
            ]);

            //Works out the total cost of the order
            $total_cost = 0;
            foreach ($basket_Items as $item){
                $product = Product::find($item->product_id);
                $total_cost += $product->price * $item->quantity;
            }

            //Creates an entry into orders table
            $order = Order::create([
                'status' => 'Paid',
                'total_cost' => $total_cost,
                'user_id' => Auth::id(),
                'delivery_id' => $delivery->id,
            ]);

            //Creates entries to the order_items table and adjusts the stock
            foreach($basket_Items as $item){
                $product = Product::find($item->product_id);

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $item->quantity,
                    'price' => $product -> price,
                ]);

                //Adjusts the stock of the item by how many hte user ordered
                $product->stock -= $item->quantity;
                $product->save();
            }

            //Deletes the user's cart now that they have checked out
            Cart::where('user_id', Auth::id())->delete();

        });

        // Checkout Notification
        return redirect()->route('basket')->with('success', 'Your order has been placed successfully!');
    }
}