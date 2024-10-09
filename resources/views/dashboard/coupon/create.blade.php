@extends('layouts.dashboard')

@section('page-title' , 'Create Coupon')

@section('content')

@include('errors')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Create Coupon
                </div>
                <div class="card-body">
                    <form action="{{route('coupon.store')}}" method="POST" >
                        @csrf
                        <div class="form-group">
                          <label for="name">Coupon Number</label>
                          <input type="number" readonly class="form-control" name="coupon" id="coupon" placeholder="coupon number" value="{{old('coupon')}}" required>
                          <br>
                          <button id="coupon-gen-btn" type="button" style="padding: 8px; border-radius: 6px; box-shadow: 0 0 ; background-color:#007bff; color: white; border:none">generate number</button>
                        </div>
                        <div class="form-group">
                            <label for="image">Discount Amount</label>
                            <input type="number" max="99" maxlength="2" class="form-control" name="discount_amount" id="coupon" placeholder="%amount" value="{{old('discount_amount')}}" required>
                            <p style="font-size: 12px">you will input an amount which will be count it with hundred percent (%)</p>
                          </div>
                          <input type="hidden" name="status" value="1">
                        <button type="submit" class="btn btn-success">Create</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

<script>
    let coupon_field = document.getElementById('coupon');
    let generate_random_btn = document.getElementById('coupon-gen-btn');
    generate_random_btn.onclick = function () {
        let x = Math.floor(10000 + Math.random() * 90000);
        coupon_field.value = x;
        
    }
</script>
    
@endsection