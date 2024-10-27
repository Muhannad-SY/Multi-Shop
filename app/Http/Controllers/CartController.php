<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{

    public function index(){
        $cart = json_decode(Cookie::get('cart', '[]') , true);
        $categories = Category::where('status' , '>' , 0)->get();
        $productIds = array_column($cart['products'] ?? [], 'product_id');
        $products = Product::whereIn('id' , $productIds)->get();
        return view('theme.cart.index' , compact('cart' , 'categories' , 'products'));
    }


    public function addToCart(Request $request){

        $cart = json_decode(Cookie::get('cart', '[]') , true);

        if (!isset($cart['products'])) {
            $cart['products'] = [];
        }
        $cart ['products'][] =[
            'product_id' => $request->product_id,
            'product_price' => $request->product_price,
            'product_count' => $request->product_count, 
            
        ];

        Cookie::queue('cart' , json_encode($cart) , 60);
        $cart = json_decode(Cookie::get('cart', '[]') , true);
    
        return response()->json(compact('cart'));
    }

    public function removeFromCart(Request $request){

        $cart = json_decode(Cookie::get('cart', '[]') , true);
        $new_total = $request->total;
        foreach ($cart['products'] as $key => $product) {
            if ($product['product_id'] == $request->product_id) {
                $new_total -= ($product['product_price'] * $product['product_count']);
                unset($cart['products'][$key]);
                $cart['products'] = array_values($cart['products']);
                break;
            }
        }

        Cookie::queue('cart' , json_encode($cart) ,60);
        
        $cart = json_decode(Cookie::get('cart', '[]') , true);

        return response()->json(['cart' => $cart , 'newtotal' => $new_total]);
        
    }

    
    public function editProductCountInCart(Request $request){

        $cart = json_decode(Cookie::get('cart', '[]') , true);
        $editTotal = [];
        foreach ($cart['products'] as &$product) {
            if ($product['product_id'] == $request->product_id && $request->status == 'plus') {
                $product['product_count'] = $product['product_count'] + 1 ; 
                $editTotal['plus'] = [$product['product_price']];
                break;
            }elseif($product['product_id'] == $request->product_id && $request->status == 'minus'){
                $product['product_count'] = $product['product_count'] - 1 ;
                $editTotal['minus'] = [$product['product_price']]; 
                break;
            }
        }

        Cookie::queue('cart' , json_encode($cart) , 60);

        return response()->json([$editTotal]);
        
    }
}
