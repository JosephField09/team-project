<?php

namespace App\Http\Controllers;

class AboutUsController extends Controller
{
    public function index()
    {
        return view('about-us'); // returns the about-us.blade.php view
    }
}
