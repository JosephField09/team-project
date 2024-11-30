<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product; 
use Illuminate\Support\Facades\Auth; 


class BasketController extends Controller
{
    public function index() {
        if (Auth::check()) {
            $userId = Auth::id(); 
            $basket_Items = Cart::with('product')->where('user_id', $userId)->get();             
        } else {
            $basket_Items = collect(session('basket', [])); 
            $productId = $basket_Items->pluck('product_id')->toArray();
            $products = Product::whereIn('id', $productId)->get()->keyBy('id'); 

            $basket_Items = $basket_Items->map(function ($item) use ($products) { 
                $item['product'] = $products[$item['product_id']] ?? null; 
                return (object) $item; 
            }); 
        }

        return view('basket', compact('basket_Items')); 
    }
    
    public function add(Request $request) {
        $request->validate(['product_id' => 'required|exists:products,id', 'quantity' => 'required|integer|min:1',]);

        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);

        if (Auth::check()) {
            $userId = Auth::id(); 
            $cart_Item = Cart::where('user_id', $userId)->where('product_id', $productId)->first(); 

            if ($cart_Item) {
                $cart_Item->quantity += $quantity; 
                $cart_Item->save(); 
            } else {
                Cart::create(['user_id' => $userId, 'product_id' => $productId, 'quantity' => $quantity,]);
            }

        } else {
            $basket = session('basket', []);
            $exists = false; 

            foreach ($basket as &$item) {
                if ($item['product_id'] == $productId) {
                    $item['quantity'] += $quantity; 
                    $exists = true; 
                    break; 
                }
            } 

            if (!$exists) {
                $basket[] = ['product_id' => $productId, 'quantity' => $quantity, ]; 
            }

            session(['basket' => $basket]);
        } 

        return redirect()->route('basket');
    } 

    public function update(Request $request, $id) {
        $request->validate(['quantity' => 'required|integer|min:1',]);
        $quantity = $request->input('quantity');

        if (Auth::check()) {
            $cart_Item = Cart::findOrFail($id);
            $cart_Item->quantity = $quantity; 
            $cart_Item->save();
        } else {
            $basket = session('basket', []);
            foreach ($basket as &$item) {
                if ($item['product_id'] == $id) {
                    $item['quantity'] = $quantity;
                    break; 
                }
            }
            session(['basket' => $basket]);
        }

        return redirect()->route('basket');
    }

    public function remove($id) {
        if (Auth::check()) {
            $cart_Item = Cart::findOrFail($id);
            $cart_Item->delete(); 
        } else {
            $basket = session('basket', []); 
            $basket = array_values(array_filter($basket, function ($item) use ($id) {
                return $item['product_id'] != $id;
            }));
            session(['basket' => $basket]);
        }
        return redirect()->route('basket'); 
    }
    
    
}
