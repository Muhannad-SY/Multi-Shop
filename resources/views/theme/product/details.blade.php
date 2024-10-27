@extends('layouts.theme')

@section('page-title', 'Product Details')

@section('content')


    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner bg-light">
                        @foreach ($product->images as $image)
                            <div class="carousel-item {{ $loop->index == 0 ? 'active' : '' }}">
                                <img class="w-100 h-100" src="{{ asset('storage/products/' . $image->path) }}" alt="Image">
                            </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                        <i class="fa fa-2x fa-angle-left text-dark"></i>
                    </a>
                    <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                        <i class="fa fa-2x fa-angle-right text-dark"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <div style="display: flex; justify-content:space-between">
                        <h3>{{ $product->name }}</h3>
                        <strong style="color: {{ $product->stock <= 100 ? 'red' : 'black' }}">
                            Left {{ $product->stock }}
                        </strong>
                    </div>

                    <div class="d-flex mb-3">
                        <div class="text-primary mr-2">
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star-half-alt"></small>
                            <small class="far fa-star"></small>
                        </div>
                        <small class="pt-1">(Reviews {{ $product->reviews_count }})</small>
                    </div>
                    <div style="display: flex; align-items:flex-end ">
                        @if ($product->discount_price != null)
                            <h3>${{ $product->discount_price }}</h3>
                            <h5 class="text-muted ml-2">
                                <del>${{ $product->price }}</del>
                            </h5>
                        @else
                            <h3>${{ $product->price }}</h3>
                        @endif
                    </div>
                    <br>
                    <h4>Description</h4>
                    <p class="mb-4">{{ $product->description }}</p>

                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-minus">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            {{-- /////////////////////////////////////// --}}
                            <input type="text" id="stock-input" class="form-control bg-secondary border-0 text-center"
                                value="1">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <button
                            class="btn btn-warning btn-sm add-to-cart-{{ $product->id }} {{ in_array($product->id, array_column($cart['products'] ?? [], 'product_id')) ? 'btn-danger' : 'btn-warning' }}"
                            onclick="handleAddToCart({{ $product->id }},{{ $product->discount_price != null ? $product->discount_price : $product->price }}, 1 , {{ $product->id }})">
                            {{ in_array($product->id, array_column($cart['products'] ?? [], 'product_id')) ? 'Remove from Cart' : 'Add to Cart' }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="bg-light p-30">
                    <div class="nav nav-tabs mb-4">
                        <a class="nav-item nav-link text-dark active" data-toggle="tab" href="#tab-pane-1">Description</a>
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-3">Reviews
                            ({{ $product->reviews_count }})</a>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab-pane-1">
                            <h4 class="mb-3">Product Description</h4>
                            <p>{{ $product->in_description }}</p>
                        </div>

                        <div class="tab-pane fade" id="tab-pane-3">
                            <div class="row">
                                <div class="col-md-6">
                                    @foreach ($product->reviews as $review)
                                        <h4 class="mb-4">{{ $loop->index + 1 }} review for "Product Name"</h4>
                                        <div class="media mb-4">
                                            <img src="{{ asset('theme/img/user.jpg') }}" alt="Image"
                                                class="img-fluid mr-3 mt-1" style="width: 45px;">
                                            <div class="media-body">
                                                <h6>{{ $review->user->name }}<small> -
                                                        <i>{{ $review->created_at->diffForHumans() }}</i></small></h6>
                                                <div class="text-primary mb-2">
                                                    @for ($i = 0; $i < 5; $i++)
                                                        @if ($i < $review->stars)
                                                            <i class="fas fa-star"></i>
                                                        @else
                                                            <i class="far fa-star"></i>
                                                        @endif
                                                    @endfor
                                                </div>
                                                <p>{{ $review->body }}</p>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->
@endsection

@section('js')

    <script>
        $(document).ready(function() {
            
            $('.btn-plus').on('click', function() {
                var counter = parseInt($('#stock-input').val());
                if (counter <  {{$product->stock}}) {
                $('#stock-input').val(counter + 1);
                }
            });
            $('.btn-minus').on('click', function() {
                var counter = parseInt($('#stock-input').val());
                if (counter > 1) {
                $('#stock-input').val(counter - 1);
                }
            });
        })
    </script>
    <script>
        // function to add and remove products from cart in 

        // {   the home page and products page    } 
        function handleAddToCart(id, price, count, index) {

            var button = $('.add-to-cart-' + index);

            if (button.text().trim() === 'Add to Cart') {
                var counter = parseInt($('#stock-input').val());
                $.ajax({
                    url: '{{ route('cart.add') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        product_id: id,
                        product_price: price,
                        product_count: counter,
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
