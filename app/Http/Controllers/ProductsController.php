<?php

namespace App\Http\Controllers;

class ProductsController extends Controller
{
    public function index()
    {
        return view('products'); // returns the products.blade.php view
    }
}

