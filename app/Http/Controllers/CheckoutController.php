<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CheckoutController extends Controller
{
    public function index(){
        $cart = json_decode(Cookie::get('cart', '[]') , true);
        $user = auth()->user();
        $addresses = Address::where('user_id' , $user->id)->orderBy('default_address' , 'DESC')->get();
        return [$user , $addresses];
    }
}
