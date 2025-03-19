<?php

namespace App\Http\Controllers;
use App\Models\WebsiteReview;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function index()
    {
        $reviews = WebsiteReview::with('user')->latest()->take(5)->get();
        return view('about-us', ['reviews'=>$reviews]);
    }
}
