<?php

namespace App\Http\Controllers;

use App\Mail\OrderAccepted;
use App\Mail\OrderCreated;
use App\Mail\Orderreceived;
use App\Mail\OrderShipped;
use App\Models\Address;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Order_Detail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::OrderBy('created_at', 'desc')->get();
        return view('dashboard.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $cart = json_decode(Cookie::get('cart', '[]'), true);

        $productIds = array_column($cart['products'] ?? [], 'product_id');
        $products = Product::whereIn('id', $productIds)->get();
        $coupon = Coupon::where('discount_amount', $request->coupon_amaunt)->first(); 

        $total_quantity = 0;
        $total = 0;
        foreach ($cart['products'] as $item) {
            $total_quantity += $item['product_count'];
            $total += $item['product_price'] * $item['product_count'];
        }
        $order = Order::create([
            'user_id' => $request->user()->id,
            'address_id' => $request->address,
            'coupon_id' => $coupon->id ?? 0,
            'total_quantity' => $total_quantity,
            'total' => $total,
            'status' => 1,
        ]);

        foreach ($cart['products'] as $item) {
            foreach ($products as $product) {
                if ($item['product_id'] == $product->id) {
                    Order_Detail::create([
                        'order_id' => $order->id,
                        'product_id'=>  $product->id,
                        'quanity' => $item['product_count'],
                        'price' => $item['product_price'],
                        'discount_sold' =>  $product->discount_price != null? true :false ,
                    ]);
                }
            }
        }
        $ord = Order::where('id', $order->id)->with(['address', 'order__details' , 'coupon'])->first();

        Mail::to($request->user()->email)->send(new OrderCreated($ord, $products));
        $cart = [];
        Cookie::queue('cart', json_encode($cart), 60);
        return view('theme.checkout.order_created');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function orderInprogress(Order $order)
    {
        
        $ord = $order->where('id' , $order->id)->with('address')->first();
        // return new OrderAccepted($ord);
        $order->update([
            'status' => 2
        ]);
        Mail::to($order->user->email)->send(new OrderAccepted($ord));

        return redirect()->back()->with('success' , 'The order became In Progress');
    }

    public function orderReject(Order $order)
    {
        $order->update([
            'status' => 0
        ]);
        return redirect()->back()->with('success' , 'The order has been rejected.');
    }

    public function orderComplated(Order $order)
    {
        $order->update([
            'status' => 3
        ]);
        return redirect()->back()->with('success' , 'The order has been rejected.');
    }

    public function orderShippe(Order $order)
    {
        $ord = $order->where('id' , $order->id)->with('address')->first();
        
        $order->update([
            'status' => 4
        ]);
        Mail::to($order->user->email)->send(new OrderShipped($ord));

        return redirect()->back()->with('success' , 'The order has been rejected.');
    }

    public function orderDone(Order $order)
    {
        // this function will work from costumers pages when 
        // the order will be recived 
        $ord = $order->where('id', $order->id)->with(['address', 'order__details' , 'coupon'])->first();

        $proIds = array_column(json_decode($ord->order__details) , 'product_id');;
        $products = Product::whereIn('id' , $proIds)->get();
        
        // Zafer mahallesi. Ağaçeşme sokak. Sabancı AP NO: 13  İç kapı NO: 4. Bahçelievler / istanbul
        $order->update([
            'status' => 5
        ]);
        Mail::to($order->user->email)->send(new Orderreceived($ord , $products));

        return redirect()->back();
    }
    /**
     * Display the specified resource.
     */

     public function myOrders(){
        $orders = auth()->user()->orders;
        $categories = Category::where('status', '>', 0)->get();
        return view('theme.order.index', compact('orders' , 'categories'));
    }

    public function showOrder($id){
        $order = Order::find($id);
        $orderDetails = $order->order__details;
        $categories = Category::where('status', '>', 0)->get();

        return view('theme.order.details', compact('order', 'orderDetails' , 'categories'));
    }


    public function show(Order $order)
    {
        // return $order;
        $details = $order->order__details;
        // return $details;
        return view('dashboard.orders.details', compact('details', 'order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
