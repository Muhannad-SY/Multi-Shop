<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

use function PHPUnit\Framework\isEmpty;

class CouponController extends Controller
{
    //

    public function index()
    {
        $coupons = Coupon::all();
        return view('dashboard.coupon.index', compact('coupons'));
    }

    public function create()
    {
        return view('dashboard.coupon.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'coupon' => 'required|int',
            'discount_amount' => 'required|int',
        ]);

        Coupon::create($request->all());

        return redirect()->route('coupon.index')->with('success', 'Coupon created successfully');
    }

    public function applyCoupon(Request $request)
    {
        $coupon = Coupon::where('coupon', $request->coupon)->first();
    //    return $coupon;
    
        if (!$coupon) {
            return response()->json(['error' => 'Inactive or Invalid Coupon'], 404);
        }

        $cart = json_decode(Cookie::get('cart', '[]') , true);

       $newTotal = 0;
        foreach($cart['products'] as $item){
           $newTotal +=   $item['product_count'] * $item['product_price'];
        }
        $discountAmount = $coupon->discount_amount;
        $newTotal = max(0, $newTotal - $discountAmount);
        
    
        return response()->json([
            'coupon_amount' => $discountAmount,
            'new_total' => $newTotal,
        ]);
    }

    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return redirect()->back()->with('success', 'coupon deleted successfuly');
    }
}
