@extends('layouts.theme')

@section('page-title', 'Cart')

@section('content')
    @include('alert')
    @php
        $items_count = 0;
        $subtotal = 0;
        $coupon = $coupon_amaunt ?? 0;
    @endphp
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    @foreach ($cart['products'] ?? [] as $product)
                        @php
                            $items_count += $product['product_count'];
                            $subtotal += $product['product_price'] * $product['product_count'];
                        @endphp
                        <tbody class="align-middle" id="remove-button{{ $loop->index }}">
                            <tr>

                                @foreach ($products as $item)
                                    @if ($product['product_id'] == $item->id)
                                        <td class="align-middle"><img
                                                src="{{ asset('storage/products/' . $item->images[0]['path']) }}"
                                                alt="" style="width: 50px;">

                                        </td>
                                    @endif
                                @endforeach

                                <td class="align-middle">${{ $product['product_price'] }}</td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-minus"
                                                id="minus-button{{ $loop->index }}"
                                                onclick="minusCount({{ $product['product_id'] }} , {{ $product['product_price'] }} , {{ $loop->index }})">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" readonly
                                            class="form-control form-control-sm bg-secondary border-0 text-center"
                                            value="{{ $product['product_count'] }}" id="count-input{{ $loop->index }}">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-plus"
                                                id="plus-button{{ $loop->index }}"
                                                onclick="plusCount({{ $product['product_id'] }} , {{ $product['product_price'] }} , {{ $loop->index }})">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle" id="total-price{{ $loop->index }}">
                                    ${{ $product['product_price'] * $product['product_count'] }}</td>
                                <td class="align-middle"><button class="btn btn-sm btn-danger"
                                        onclick="removeProductFromCart({{ $product['product_id'] }} , {{ $product['product_count'] }} , {{ $loop->index }})"><i
                                            class="fa fa-times"></i></button></td>
                            </tr>
                        </tbody>
                    @endforeach
                </table>
            </div>
            <div class="col-lg-4">
                <form class="mb-30" id="coupon-form">
                    @csrf
                    <div class="input-group">
                        <input type="text" maxlength="5" name="coupon" id="coupon-code"
                            class="form-control border-0 p-4" placeholder="Coupon Code">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-primary" id="coupon-apply-btn">Apply Coupon</button>
                        </div>
                    </div>
                </form>
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart
                        Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between ">
                            <h6 class="font-weight-medium">Subtotal</h6>
                            <h6 class="font-weight-medium" id="items-subtotal">${{ $subtotal }}</h6>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <h6 class="font-weight-medium">Item Count</h6>
                            <h6 class="font-weight-medium" id="items-count-state">{{ $items_count }}</h6>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <h6 class="font-weight-medium">Coupun discount</h6>
                            <h6 class="font-weight-medium" id="coupon">${{ $coupon }}</h6>
                        </div>

                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="total">${{ $subtotal - ($coupon ?? 0) }}</h5>
                        </div>
                        <a href="{{route('checkout.index')}}">
                            <button class="btn btn-block btn-primary font-weight-bold my-3 py-3">
                                Proceed To Checkout
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->

@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#coupon-apply-btn').on('click', function() {
                if ({{ count($cart['products'] ?? []) > 0 }}) {
                    $.ajax({
                        url: '{{ route('apply.coupon') }}',
                        type: 'Get',
                        data: {
                            _token: '{{ csrf_token() }}',
                            coupon: $('#coupon-code').val(),
                        },
                        success: function(response) {
                            $('#coupon').text('$' + response.coupon_amount);
                            $('#total').text('$' + response.new_total);
                        },

                    });
                }
            });
        });
    </script>
    <script>
        // function to add and remove products from cart in 
        // {   the home page and products page    } 
        function removeProductFromCart(id, minuse_count, index) {
            var items_count = $('#items-count-state').text();
            var items_subtotal = $('#items-subtotal').text().replace('$', '');
            var items_subtotal = $('#total').text().replace('$', '');
            var total_item_price = $('#total-price' + index).text().replace('$', '');
            var total = $('#total').text().replace('$', '');
            $one_cart = $('#remove-button' + index);
            $.ajax({
                url: '{{ route('cart.remove') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    product_id: id,
                    total: total
                },
                success: function(res) {
                    $('#items-count-state').text(+items_count - minuse_count);
                    $('#items-subtotal').text('$' + (+items_subtotal - total_item_price));
                    $('#cart-item-counter').text(--res.cart.products.length);
                    $one_cart.css('display', 'none');
                    // console.log(res.newtotal);

                    $('#total').text('$' + res.newtotal)
                }
            });
        } // end of the function


        // function to plus count
        function plusCount(id, price, index) {
            var items_count = $('#items-count-state').text();
            var items_subtotal = $('#items-subtotal').text().replace('$', '');
            var total = $('#total').text().replace('$', '');
            $.ajax({
                url: '{{ route('cart.edit.count') }}',
                method: 'GET',
                data: {
                    _token: '{{ csrf_token() }}',
                    product_id: id,
                    status: 'plus'
                },
                success: function(res) {
                    var counter = parseInt($('#count-input' + index).val());
                    $('#items-count-state').text(+items_count + 1);
                    $('#count-input' + index).val(counter + 1);
                    $('#items-subtotal').text('$' + (+items_subtotal + price));
                    var total_price = $('#total-price' + index).text().replace('$', '');
                    $('#total-price' + index).text('$' + (+total_price + price)); // here
                    $('#total').text('$' + (+total + (+res[0]['plus'])));
                }
            });
        }
        // function to minus count

        function minusCount(id, price, index) {
            var items_count = $('#items-count-state').text();
            var counter = parseInt($('#count-input' + index).val());
            var items_subtotal = $('#items-subtotal').text().replace('$', '');
            var total = $('#total').text().replace('$', '');
            if (counter > 1) {

                $.ajax({
                    url: '{{ route('cart.edit.count') }}',
                    method: 'GET',
                    data: {
                        _token: '{{ csrf_token() }}',
                        product_id: id,
                        status: 'minus'
                    },
                    success: function(res) {

                        $('#items-count-state').text(+items_count - 1);

                        $('#count-input' + index).val(counter - 1);
                        $('#items-subtotal').text('$' + (+items_subtotal - price));
                        var total_price = $('#total-price' + index).text().replace('$', '');
                        $('#total-price' + index).text('$' + (+total_price - price));
                        $('#total').text('$' + (+total - (+res[0]['minus'])));
                    }
                });
            }
        }
    </script>
@endsection
