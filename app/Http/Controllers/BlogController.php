<?php

namespace App\Http\Controllers;

class BlogController extends Controller
{
    public function index()
    {
        return view('blog'); // returns the blog.blade.php view
    }
}
