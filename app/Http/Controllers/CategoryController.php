<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;

class CategoryController extends Controller
{
    public function add_category(Request $request)
    {
        $category = new Category;

        $category->name = $request->category;

        $category->save();

    }
}
