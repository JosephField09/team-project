<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        return view('products'); // returns the products.blade.php view
    }
    public function add_product(Request $request)
    {
        $data = new Product();

        $data->name = $request->name;
        $data->description = $request->description;
        $data->price = $request->price;
        $data->size = $request->size;
        $data->stock = $request->stock;
        $data->category_id = $request->category_id;

        $data ->save();

        // Redirect or return a response
        return redirect()->route('admin.dashboard',['tab' => 'allProducts'])->with('status', 'product-added');
    }

}

