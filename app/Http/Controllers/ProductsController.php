<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class ProductsController extends Controller
{
    public function index()
    {
        $product = Product::all();
        return view('products',compact('product')); // returns the products.blade.php view
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

        $image = $request -> image;
        if($image)
        {
            $imagename = time(). '.'.$image->getClientOriginalExtension();

            $request->image->move('products', $imagename);

            $data->image = $imagename;
        }

        $data ->save();

        // Redirect or return a response
        return redirect()->route('admin.dashboard',['tab' => 'allProducts'])->with('status', 'product-added');
    }

    public function details($id)
    {
        $data = Product::find($id);
        return view('product-details',compact('data')); // returns the products.blade.php view
    }

}

