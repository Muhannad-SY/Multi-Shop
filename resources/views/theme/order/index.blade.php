@extends('layouts.theme')


@section('page-title', 'My Orders')

@section('content')

    <!-- Single Page Header End -->
    @include('alert')
    <div class="container my-5">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-12">
                                <h4 class="card-title">My Orders</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Order ID</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Total Quantity</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->address->adreess }}</td>
                                        <td>{{ $order->total_quantity }}</td>
                                        <td>{{ $order->total }}</td>
                                        <td>
                                            <a href="{{route('show.one.order',$order->id)}}" class="btn btn-warning btn-sm" >Details</a>
                                        </td>
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
