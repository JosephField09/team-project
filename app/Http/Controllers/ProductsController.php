<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::all();
        $categories = Category::all(); // Retrieve all categories for the dropdown

        return view('products', compact('products', 'categories'));
    }

    public function filter(Request $request)
    {
        $query = Product::query();

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Filter by price range
        if ($request->filled('min_price') || $request->filled('max_price')) {
            $query->whereBetween('price', [
                $request->get('min_price', 0), 
                $request->get('max_price', PHP_INT_MAX)
            ]);
        }

        // Search by product name or category name
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                ->orWhereHas('category', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%');
                });
            });
        }

        // Sort products
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'name_asc':
                    $query->orderBy('name', 'asc');
                    break;
                case 'name_desc':
                    $query->orderBy('name', 'desc');
                    break;
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
            }
        }

        // Get filtered and sorted products
        $products = $query->get();
        $categories = Category::all(); // Retrieve all categories for the dropdown

        return view('products', compact('products', 'categories'));
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

        if ($request->hasFile('image')) {
            $image = $request->file('image'); 
    
            $imagename = $image->getClientOriginalName();
    
            // Save the file to the 'public/assets' folder
            $image->move(public_path('assets'), $imagename);
    
            $data->image = $imagename;
        }

        $data ->save();

        // Redirect or return a response
        return redirect()->route('admin.dashboard',['tab' => 'allProducts'])->with('status', 'product-added');
    }

    public function details($id)
    {
        $data = Product::findOrFail($id);
        $relatedProducts = Product::where('name', $data->name)->get();

        return view('product-details', compact('data', 'relatedProducts'));
    }


}