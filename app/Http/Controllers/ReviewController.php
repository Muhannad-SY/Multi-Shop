<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(){
        $reviews = Review::where('status' , '2')->get();
        return view('dashboard.review.index' , compact('reviews'));
    }
    public function panding(){
        $pandings = Review::where('status' , '1')->get();
        return view('dashboard.review.panding' , compact('pandings'));
    }

    public function accept($id){
        $review = Review::find($id);
        $review->update([
            'status' => '2'
        ]);

        return redirect()->route('review.panding')->with('success' , 'Review Accepted');
    }

    public function delete($id){
        $review = Review::find($id);
        $review->delete();
        return redirect()
        ->back()
        ->with('success' , 'Review Deleted Successfuly');
    }
}
