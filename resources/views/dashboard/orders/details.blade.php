@extends('layouts.dashboard')

@section('page-title', 'Order Details')

@section('content')
    @include('alert')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Shipping Address</h3>
                    </div>
                    <div class="card-body">
                        <p>
                            {{ $order->address->adreess }}
                        </p>
                        @if ($order->status == 1)
                        <br>
                        <h4>Do you accept or reject?</h4>
                        <div style="display: flex">
                            <form action="{{ route('order.inprogress', $order) }}" method="post">
                                @csrf
                                @method('put')

                                <button type="submit" class="btn btn-primary">Accept</button>
                            </form>
                            <form action="{{ route('order.reject', $order) }}" method="post">
                                @csrf
                                @method('put')

                                <button type="submit" class="btn btn-danger ml-2">Reject</button>

                            </form>
                        </div>
                        @elseif($order->status == 0 )
                        <h4 style="color: red">This order has been rejected.</h4>
                        @elseif($order->status == 2 )
                        <h5 >Order in Progress</h5>
                        <form action="{{ route('order.complated', $order) }}" method="post">
                            @csrf
                            @method('put')
                            <button type="submit" class="btn btn-success ml-2">Order Have been completed</button>
                        </form>
                        @elseif($order->status == 3 )
                        <h5 >Order is ready to be shipped</h5>
                        <form action="{{ route('order.shippe', $order) }}" method="post">
                            @csrf
                            @method('put')
                            <button type="submit" class="btn btn-success ml-2">Shippe</button>
                        </form>
                        @elseif($order->status == 4 )
                        <h3 >The order shipped</h3>
                        @elseif($order->status == 5 )
                        <h3 style="color: red">Order Is Done</h3>
                        @endif
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
                                        <td>{{ $detail->quanity * $detail->product->price }}</td>

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
