<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Add a category from admin panel.
     */
    public function add_category(Request $request)
    {
        $category = new Category;

        $category->name = $request->category;

        $category->save();

        return redirect()->route('admin.dashboard',['tab' => 'allProducts']);
    }

    /**
     * Delete a specific category from admin panel.
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.dashboard', ['tab' => 'allProducts'])->with('status', 'User deleted successfully!');
    }
}
