@extends('layouts.mail')

@section('css')
<style>
    .order-summary { width: 100%; border-collapse: collapse; margin-top: 20px; }
.order-summary th, .order-summary td { padding: 10px; border: 1px solid #ddd; text-align: left; }
.order-summary th { background-color: #f8f8f8; }
.summary-details { margin-top: 20px; }
.summary-details p { margin: 5px 0; }
.total { font-weight: bold; }
</style>
@endsection
@section('mail-title' , 'You have been received the order successfuly!')

@section('imoge')
<img src="{{$message->embed(public_path('theme/img/recieved.png'))}}" alt="open-box">
@endsection


@section('body')
<div class="container">       
    <!-- Order Details Table -->
    <table class="order-summary">
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order__details as $item)
                <tr>
                    @foreach ($products as $product)
                        @if ($item->product_id == $product->id)
                        <td>{{ $product->name }}</td>
                        @endif
                    @endforeach
                    <td>{{ $item->quanity }}</td>
                    <td>${{$item->price }}</td>
                    <td>${{$item->quanity * $item->price }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Order Summary -->
    <div class="summary-details">
        <p>Subtotal: ${{$subtotal }}</p>
        <p>Coupon Discount: -${{ $coupon }}</p>
        <p class="total">Total: ${{ $subtotal - $coupon }}</p>
    </div>
</div>    
@endsection
