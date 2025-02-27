<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch the products by their IDs. 
        $bestSellers = DB::table('order_item')
            ->join('products', 'order_item.product_id', '=', 'products.id')
            ->select(
                'products.id',
                'products.name',
                'products.size',  
                'products.description',   
                'products.image',  
                'products.price',  
                DB::raw('SUM(order_item.quantity) as total_sold')
            )
            ->groupBy(
                'products.id',
                'products.name',
                'products.size',
                'products.description',
                'products.image',
                'products.price'
            )
            ->orderByDesc('total_sold')
            ->limit(3)
            ->get();
        return view('home', ['bestSellers' => $bestSellers]);
    }
}