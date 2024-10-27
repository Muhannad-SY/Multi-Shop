@extends('layouts.theme')

@section('page-title', 'Shop')

@section('content')

    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by
                        price</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form action="{{ route('products.price.filter.shop') }}" method="GET" id="filter-product-price">
                        @csrf
                        <div class="custom-control custom-radio d-flex align-items-center justify-content-between mb-3">
                            <input type="radio" name="p" value="1" class="custom-control-input" id="price-1">
                            <label class="custom-control-label" for="price-1">$0 - $100</label>
                            <span class="badge border font-weight-normal">150</span>
                        </div>
                        <div class="custom-control custom-radio d-flex align-items-center justify-content-between mb-3">
                            <input type="radio" name="p" value="2" class="custom-control-input" id="price-2">
                            <label class="custom-control-label" for="price-2">$100 - $300</label>
                            <span class="badge border font-weight-normal">295</span>
                        </div>
                        <div class="custom-control custom-radio d-flex align-items-center justify-content-between mb-3">
                            <input type="radio" name="p" value="3" class="custom-control-input" id="price-3">
                            <label class="custom-control-label" for="price-3">$300 - $800</label>
                            <span class="badge border font-weight-normal">246</span>
                        </div>
                        <div class="custom-control custom-radio d-flex align-items-center justify-content-between mb-3">
                            <input type="radio" name="p" value="4" class="custom-control-input" id="price-4">
                            <label class="custom-control-label" for="price-4">$800 - $1000</label>
                            <span class="badge border font-weight-normal">145</span>
                        </div>
                        <div class="custom-control custom-radio d-flex align-items-center justify-content-between">
                            <input type="radio" name="p" value="5" class="custom-control-input" id="price-5">
                            <label class="custom-control-label" for="price-5">$1000 - $2000</label>
                            <span class="badge border font-weight-normal">168</span>
                        </div>
                    </form>
                </div>
                <!-- Price End -->
            </div>

            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    @if ($filter_case == 0)
                        @foreach ($products as $product)
                            {{-- here will be the Normal peace without filter. --}}
                            <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                <div class="product-item bg-light mb-4">
                                    <div class="product-img position-relative overflow-hidden">
                                        <img class="img-fluid w-100"
                                            src="{{ asset('storage/products/' . $product->images[0]['path']) }}"
                                            alt="">
                                        <div class="product-action">
                                            <a class="btn btn-outline-dark btn-square" href=""><i
                                                    class="fa fa-shopping-cart"></i></a>
                                            <a class="btn btn-outline-dark btn-square" href=""><i
                                                    class="far fa-heart"></i></a>
                                            <a class="btn btn-outline-dark btn-square"
                                                href="{{ route('product.details', $product) }}"><i
                                                    class="fa fa-eye"></i></a>
                                        </div>
                                    </div>
                                    <div class="text-center py-4">
                                        <a class="h6 text-decoration-none text-truncate"
                                            href="">{{ $product->name }}</a>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            @if ($product->discount_price != null)
                                                <h5>${{ $product->discount_price }}</h5>
                                                <h6 class="text-muted ml-2">
                                                    <del>${{ $product->price }}</del>
                                                </h6>
                                            @else
                                                <h5>${{ $product->price }}</h5>
                                            @endif
                                        </div>
                                        <div class="d-flex align-items-center justify-content-center mb-1">
                                            <button
                                                class="btn btn-warning btn-sm add-to-cart-{{ $product->id }} {{ in_array($product->id, array_column($cart['products'] ?? [], 'product_id')) ? 'btn-danger' : 'btn-warning' }}"
                                                onclick="handleAddToCart({{ $product->id }},{{ $product->discount_price != null ? $product->discount_price : $product->price }}, 1 , {{ $product->id }})">
                                                {{ in_array($product->id, array_column($cart['products'] ?? [], 'product_id')) ? 'Remove from Cart' : 'Add to Cart' }}
                                            </button>
                                        </div>
                                        <div style="display: flex; gap:20px; justify-content:center ; margin-top:5px">
                                            <small>sold({{ $product['order__details_count'] }}) times</small>
                                            {!! $product->stock <= 100 ? '<small style="color: red">left count' . $product->stock . '</small>' : '' !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @elseif($filter_case == 1)
                        {{-- Here will be the filtered cases. --}}
                        @if ($products->isEmpty())
                            <div class="col-12 pb-1">
                                <h3>NO Result</h3>
                            </div>
                        @else
                            @foreach ($products as $product)
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                    <div class="product-item bg-light mb-4">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-fluid w-100"
                                                src="{{ asset('storage/products/' . $product->images[0]['path']) }}"
                                                alt="">
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square" href=""><i
                                                        class="fa fa-shopping-cart"></i></a>
                                                <a class="btn btn-outline-dark btn-square" href=""><i
                                                        class="far fa-heart"></i></a>
                                                        <a class="btn btn-outline-dark btn-square"
                                                        href="{{ route('product.details', $product) }}"><i
                                                            class="fa fa-eye"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate"
                                                href="">{{ $product->name }}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                @if ($product->discount_price != null)
                                                    <h5>${{ $product->discount_price }}</h5>
                                                    <h6 class="text-muted ml-2">
                                                        <del>${{ $product->price }}</del>
                                                    </h6>
                                                @else
                                                    <h5>${{ $product->price }}</h5>
                                                @endif
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center mb-1">
                                                @php
                                                    $numForClassName = $product->id . rand(0, 99);
                                                @endphp
                                                <button
                                                    class="btn btn-warning btn-sm add-to-cart-{{ $numForClassName }} {{ in_array($product->id, array_column($cart['products'] ?? [], 'product_id')) ? 'btn-danger' : 'btn-warning' }}"
                                                    onclick="handleAddToCart({{ $product->id }},{{ $product->discount_price != null ? $product->discount_price : $product->price }}, 1 , {{ $numForClassName }})">
                                                    {{ in_array($product->id, array_column($cart['products'] ?? [], 'product_id')) ? 'Remove from Cart' : 'Add to Cart' }}
                                                </button>
                                            </div>
                                            <div style="display: flex; gap:20px; justify-content:center ; margin-top:5px">
                                                <small>sold({{ $product['order__details_count'] }}) times</small>
                                                {!! $product->stock <= 100
                                                    ? '<small style="color: red">left count' . $product->stock . '</small>'
                                                    : '' !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    @endif


                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->

@endsection

@section('js')
    <script>
        let price1 = document.getElementById('price-1');
        let price2 = document.getElementById('price-2');
        let price3 = document.getElementById('price-3');
        let price4 = document.getElementById('price-4');
        let price5 = document.getElementById('price-5');
        let filter = document.getElementById('filter-product-price');

        price1.onclick = function() {
            filter.submit();
        }

        price2.onclick = function() {
            filter.submit();
        }

        price3.onclick = function() {
            filter.submit();
        }

        price4.onclick = function() {
            filter.submit();
        }

        price5.onclick = function() {
            filter.submit();
        }
    </script>

    <script>
        // function to add and remove products from cart in 

        // {   the home page and products page    } 
        function handleAddToCart(id, price, count, index) {

            var button = $('.add-to-cart-' + index);

            if (button.text().trim() === 'Add to Cart') {
                $.ajax({
                    url: '{{ route('cart.add') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        product_id: id,
                        product_price: price,
                        product_count: count,
                    },
                    success: function(res) {
                        $('#cart-item-counter').text(++res.cart.products.length);
                        button.removeClass('btn-warning').addClass('btn-danger');
                        button.text('Remove from Cart');
                    }
                });
            } else {
                $.ajax({
                    url: '{{ route('cart.remove') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        product_id: id
                    },
                    success: function(res) {
                        $('#cart-item-counter').text(--res.cart.products.length);
                        button.removeClass('btn-danger').addClass('btn-warning');
                        button.text('Add to Cart');
                    }
                });
            }
        } // end of the function
    </script>

@endsection
