@extends('layouts.dashboard')

@section('page-title','Order Details')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3>Shipping Address</h3>
                </div>
                <div class="card-body">
                    <p>
                        {{$order->address->adreess}}
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3>Order Details</h3>
                </div>
                <div class="card-body">
                    <table id="order-details-table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>User Name</th>
                                <th>Product Name</th>
                                <th>Qty</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($details as $detail)
                                <tr>
                                    <td>{{ $detail->order_id }}</td>
                                    <td>{{ $detail->order->user->name }}</td>
                                    <td>{{ $detail->product->name }}</td>
                                    <td>{{ $detail->quanity }}</td>
                                    <td>{{ $detail->quanity * $detail->product->price}}</td>
                                    
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Order ID</th>
                                <th>User Name</th>
                                <th>Product Name</th>
                                <th>Qty</th>
                                <th>Total</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#order-details-table').DataTable();
        });
    </script>
@endsection
