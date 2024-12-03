<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BasketController extends Controller
{

    public function index()
    // test 
    {
        $basket_Items = [];
         return view('basket', compact('basket_Items'));

    }

}
