@extends('layouts.dashboard')


@section('page-title', 'Coupons')

@section('content')
    @include('alert')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">All Coupons</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="coupons" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    
                                    <th>ID</th>
                                    <th>Coupon Number</th>
                                    <th>Discount Amount</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($coupons as $coupon)
                                    <tr>
                                        
                                        <td>{{ $coupon->id }}</td>
                                        <td>{{ $coupon->coupon }}</td>
                                        <td>${{ $coupon->discount_amount }}</td>                                       
                                        <td>
                                            <form action="{{ route('coupon.destroy', $coupon) }}" method="POST"
                                                {{-- style="display: inline-block;" --}}
                                                >
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>


                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
@endsection


@section('scripts')
    <script>
        $(document).ready(function() {
            $('#coupons').DataTable();
        });
    </script>
@endsection
