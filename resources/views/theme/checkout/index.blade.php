@extends('layouts.theme')

@section('page-title', 'Checkout')

@section('content')


    @php
        $subtotal = 0;
    @endphp
    <!-- Checkout Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Billing
                        Address</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="row">
                        <form action="{{route('order.create')}}" method="post" class="w-100" id="order-form">
                            @csrf
                            @if (count($addresses ?? 0) > 0)
                                <div class="col-md-6 form-group">
                                    <label>Country</label>
                                    <select name="address" class="custom-select mb-2" disabled>
                                        @foreach ($addresses as $address)
                                            @if ($address->default_address == 1)
                                                <option value="{{ $address->id }}" selected>{{ $address->adreess }}
                                                </option>
                                            @else
                                                <option value="{{ $address->id }}"> {{ $address->adreess }}</option>
                                            @endif
                                        @endforeach
                                    </select>


                                </div>
                            @endif
                            <input type="hidden" name="subtotal" value="{{ $subtotal }}">
                            <input type="hidden" name="coupon_amaunt" value="{{ $coupon_amaunt ?? 0 }}">
                            
                        </form>
                        <div class="ml-3">
                            <input type="checkbox"class="mr-1" id="select-disable-checkbox">
                            <label for="select-disable-checkbox">Select Another Location</label>
                        </div>
                        
                    </div>
                </div>

            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Order
                        Total</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom">
                        <h6 class="mb-3">Products</h6>

                        @foreach ($cart['products'] ?? [] as $product)
                            @php
                                $subtotal += $product['product_price'] * $product['product_count'];
                            @endphp
                            <div class="d-flex justify-content-between">
                                <p>
                                    @foreach ($products as $item)
                                        @if ($item->id == $product['product_id'])
                                            {{ $item->name }}
                                        @endif
                                    @endforeach
                                    ({{ $product['product_count'] }})
                                </p>
                                <p>${{ $product['product_price'] * $product['product_count'] }}</p>
                            </div>
                        @endforeach
                    </div>
                    <div class="border-bottom pt-3 pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6>${{ $subtotal }}</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Coupon Discount</h6>
                            <h6 class="font-weight-medium">${{ $coupon_amaunt ?? 0 }}</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2 mb-5">
                            <h5>Total</h5>
                            <h5>${{ $subtotal - $coupon_amaunt ?? 0 }}</h5>
                        </div>
                    </div>
                    <button id="place-order-btn" class="btn btn-block btn-primary font-weight-bold py-3">Place
                        Order</button>
                </div>

            </div>
        </div>
    </div>
    <!-- Checkout End -->



@endsection

@section('js')

    <script>
        $(document).ready(function() {
            $('#select-disable-checkbox').on('change', function() {
                if ($(this).is(':checked')) {
                    $('.custom-select').prop('disabled', false);
                    $(this).prop('disabled', true);
                }
            });
        });

        $('#place-order-btn').on('click', function() {
            $('.custom-select').prop('disabled', false);
            $('#order-form').submit();
        })
    </script>
@endsection
