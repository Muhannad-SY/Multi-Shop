<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CheckoutController extends Controller
{
    public function index(Request $request){
        $cart = json_decode(Cookie::get('cart', '[]') , true);
        $user = auth()->user();
        $addresses = Address::where('user_id' , $user->id)->orderBy('default_address' , 'DESC')->get();
        $coupon_amaunt = $request->coupon_amaunt;
        $categories = Category::where('status', '>', 0)->get();
        $productIds = array_column($cart['products'] ?? [], 'product_id');
        $products = Product::whereIn('id' , $productIds)->get();

        return view('theme.checkout.index' , compact('cart' , 'addresses' , 'coupon_amaunt' , 'categories' , 'products'));
    }
}
