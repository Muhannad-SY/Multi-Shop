<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::check()) {
            $user = auth()->user();
            if ($user->hasRole('admin')) {
                return view('home');
            } else {
                $categories = Category::withCount('products')
                    ->where('status', '>', 0) // Filter categories with status = 1
                    ->get();
                $products = Product::withCount('order__details')->whereHas('category', function ($query) {
                    $query->where('status', '>', 0);
                })->where('status', '>', 0)->get();
                $cart = json_decode(Cookie::get('cart', '[]'), true);

                return view('welcome', compact('categories', 'products' , 'cart'));
            }
        } else {
            $categories = Category::withCount('products')
                ->where('status', '>', 0) // Filter categories with status = 1
                ->get();
            $products = Product::withCount('order__details')->whereHas('category', function ($query) {
                $query->where('status', '>', 0);
            })->where('status', '>', 0)->get();
            $cart = json_decode(Cookie::get('cart', '[]'), true);
            return view('welcome', compact('categories', 'products' , 'cart'));
        }
    }
}
