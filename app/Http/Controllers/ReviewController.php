<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::where('status', '2')->get();
        return view('dashboard.review.index', compact('reviews'));
    }
    public function panding()
    {
        $pandings = Review::where('status', '1')->get();
        return view('dashboard.review.panding', compact('pandings'));
    }

    public function accept($id)
    {
        $review = Review::find($id);
        $review->update([
            'status' => '2',
        ]);

        return redirect()->route('review.panding')->with('success', 'Review Accepted');
    }

    // create function to make the costumer navigate to leave review page
    public function create(Request $request, $product_id)
    {
        $user_id = $request->user()->id;
        $categories = Category::where('status', '>', 0) // Filter categories with status = 1
            ->get();
        $cart = json_decode(Cookie::get('cart', '[]'), true);

        return view('theme.review.create', compact('user_id', 'product_id' , 'categories' , 'cart'));
    }

    public function store(Request $request, $product_id)
    {
        $request->validate([
            'rating' => 'int|required',
            'body' => 'string|required'

        ]);
       $review = Review::create([
            'user_id' => $request->user()->id,
            'product_id' => $product_id,
            'stars' => $request->rating,
            'body' => $request->body
        ]);
        return redirect()->route('customer.all.orders')->with('success' , 'The review added successfuly');
    }

    public function delete($id)
    {
        $review = Review::find($id);
        $review->delete();
        return redirect()->back()->with('success', 'Review Deleted Successfuly');
    }
}
