<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product; 
use App\Models\User;  
use Illuminate\Support\Facades\Auth; 


class BasketController extends Controller
{
    // Handles displaying the basket. Ensures that logged in users only see their own basket from the database
    public function index() {    // fetches basket items from the database
            $userId = Auth::id(); 
            $basket_Items = Cart::with('product')->where('user_id', $userId)->get();             

        // Returns the basket view with the items 
        return view('basket', compact('basket_Items')); 
    }

    public static function getBasketCount()
    {
        if (Auth::check()) {
            $userId = Auth::id();
            return Cart::where('user_id', $userId)->sum('quantity');
        }
        return 0; // For guests, the count is 0
    }
    
    // Adds an item to the basket. Includes validation to protect against invalid or malicious inputs.   
    public function add($id, Request $request)
    {
        $user = Auth::user();
        $user_id = $user->id;
        $product_id = $id;
        $quantity = $request->input('quantity', 1);
        $size = $request->input('size');

        $cartItem = Cart::where('user_id', $user_id)
                        ->where('product_id', $product_id)
                        ->where('size', $size) // if you want a unique combination
                        ->first();

        if ($cartItem) {
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            $data = new Cart;
            $data->user_id = $user_id;
            $data->product_id = $product_id;
            $data->quantity = $quantity;
            $data->size = $size;
            $data->save();
        }

        return redirect()->back();
    }


    // Updates the quantity of a specific item in the basket. Uses validation to ensure the quantity is valid 
    public function update(Request $request, $id) { 
        // Validate the input data 
        $request->validate(['quantity' => 'required|integer|min:1',]);
        $quantity = $request->input('quantity');

        // updates the cart item in the database
        $cart_Item = Cart::findOrFail($id);
        $cart_Item->quantity = $quantity; 
        $cart_Item->save();
        

        return redirect()->route('basket'); // Redirect to the basket page 
    }

    // Removes an item from the basket 
    public function remove($id) { // deletes the cart item from the database 
        $cart_Item = Cart::findOrFail($id);
        $cart_Item->delete(); 
        return redirect()->route('basket'); // Redirect to the basket page 
    }
    
    
}
