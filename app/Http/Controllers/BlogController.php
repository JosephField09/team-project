<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

class BlogController extends Controller
{
    //Gets all the blogs to display
    public function index()
    {
        $blogs = Blog::with('user')->latest()->get();
        return view('blogs.index', ['blogs'=>$blogs]); // returns the view with the blog data
    }

    public function store(Request $request){
        //Makes sure that title and content is not empty
        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        //Creates a new blog post
        Blog::create([
            'title' => $request->title,
            'message' => $request->message,
            'user_id' => Auth::id(),
        ]);

        // Returns the user to the blogs page with a success message
        return redirect()->route('blogs.index');
    }
}
