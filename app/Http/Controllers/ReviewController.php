<?php
namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\WebsiteReview;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

class ReviewController extends Controller
{
    public function create_review($id)
    {
        return view('create-review',compact('id'));
    }

    public function add_review(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'title' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        if($id === "0"){
            WebsiteReview::create([
                'user_id' => Auth::id(),
                'rating' => $request->rating,
                'title' => $request->title,
                'message' => $request->message
                ]);
        } else {
            Review::create([
                'product_id' => $id,
                'user_id' => Auth::id(),
                'rating' => $request->rating,
                'title' => $request->title,
                'message' => $request->message
        ]);}

        if($id === "0"){
            return redirect()->route('about-us');
        } else {
            return redirect()->route('product-details', $id);
        }
    }
}
?>