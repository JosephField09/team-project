<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Add a category from admin panel.
     */
    public function add(Request $request)
    {
        $category = new Category;

        $category->name = $request->category;

        $category->save();

        return redirect()->route('admin.dashboard',['tab' => 'allProducts']);
    }
    
    /**
     * Edit the category from admin panel.
     */
    public function update(Request $request, $id)
    {
    $request->validate([
        'name' => 'required|string|max:255',
    ]);

    $category = Category::findOrFail($id);
    $category->name = $request->name;
    $category->save();

    return response()->json(['success' => true]);
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
