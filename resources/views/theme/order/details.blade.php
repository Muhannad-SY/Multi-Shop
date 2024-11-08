@extends('layouts.theme')

@section('page-title', 'Order Details')

@section('css')
    <link rel="stylesheet" href="{{ asset('theme/css/my-css.css') }}">
@endsection

@section('content')

    @include('alert')
    <div class="wizard">
        <a class="{{ $order->status >= 1 ? 'current' : '' }}"><span class="badge badge-inverse">1</span> In Bending</a>
        <a class="{{ $order->status >= 2 ? 'current' : '' }}"><span class="badge">2</span> In Progress</a>
        <a class="{{ $order->status >= 3 ? 'current' : '' }}"><span class="badge">3</span> Complated</a>
        <a class="{{ $order->status >= 4 ? 'current' : '' }}"><span class="badge">4</span> Shipped</a>
        <a class="{{ $order->status == 5 ? 'current' : '' }}"><span class="badge">5</span> Done</a>
    </div>
    
    <div class="container my-5">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-12" style="display: flex; justify-content:space-between">
                                <h4 class="card-title">#{{ $order->id }} Order Details</h4>
                                @if ($order->status == 4)
                                    <div style="display: flex; flex-direction: column;">
                                        <h5 style="font-wight: bold; ">Did you receive the order?</h5>
                                        <form action="{{ route('order.done', $order) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-success">yes</button>
                                        </form>
                                    </div>
                                @elseif($order->status == 0)
                                <h5 style="color: red">This order rejected</h5>
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    @if ($order->status == 5)
                                        <th scope="col">Opinion</th>
                                    @endif
                                    
                                    <th scope="col">Order ID</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Product Price</th>
                                    <th scope="col">Total Quantity</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orderDetails as $detail)
                                    <tr>
                                        @if ($order->status == 5)
                                        <td><a href="{{route('review.create' ,$detail->product->id )}}" class="btn btn-primary">Review</a></td>
                                       @endif
                                        <td>{{ $detail->order_id }}</td>
                                        <td>{{ $detail->product->name }}</td>
                                        <td>{{ $detail->product->price }}</td>
                                        <td>{{ $detail->quanity }}</td>
                                        <td>{{ $detail->product->price * $detail->quanity }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
