<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    //

    public function index(){
        $coupons = Coupon::all();
        return view('dashboard.coupon.index' , compact('coupons'));
    }

    public function create(){
        return view('dashboard.coupon.create');
    }

    public function store(Request $request){

        $request->validate([
            'coupon' => 'required|int',
            'discount_amount' => 'required|int'
        ]);

        Coupon::create($request->all());

        return redirect()->route('coupon.index')->with('success', 'Coupon created successfully');
    }

    public function destroy(Coupon $coupon){
        $coupon->delete();
        return redirect()
        ->back()
        ->with('success' , 'coupon deleted successfuly');
    }
}
