<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product; 
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
    
    // Adds an item to the basket. Includes validation to protect against invalid or malicious inputs.   
    public function add(Request $request) {  
        // Validate the input data
        $request->validate(['product_id' => 'required|exists:products,id', 'quantity' => 'required|integer|min:1',]);

        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);

        if (Auth::check()) {
            // update or creates the cart item in the database 
            $userId = Auth::id(); 
            $cart_Item = Cart::where('user_id', $userId)->where('product_id', $productId)->first(); 

            if ($cart_Item) { // If the item already exists in the basket, update the quantity
                $cart_Item->quantity += $quantity; 
                $cart_Item->save(); 
            } else {
                // Otherwise, create a new cart item 
                Cart::create(['user_id' => $userId, 'product_id' => $productId, 'quantity' => $quantity,]);
            }

        } 

        return redirect()->route('basket'); // redirect to the basket page 
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
