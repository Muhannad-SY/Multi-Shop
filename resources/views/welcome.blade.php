@extends('layouts.theme')

@section('page-title', 'Home')

@section('content')

    <div class="container-fluid mb-3">
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <div id="header-carousel" class="carousel slide carousel-fade mb-30 mb-lg-0" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#header-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#header-carousel" data-slide-to="1"></li>
                        <li data-target="#header-carousel" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item position-relative active" style="height: 430px;">
                            <img class="position-absolute w-100 h-100"
                                src="{{ asset('storage/categories/' . $categories[0]['image']['path']) }}"
                                style="object-fit: cover;">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">
                                        {{ $categories[0]['name'] }}
                                    </h1>
                                    <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Lorem rebum magna amet lorem
                                        magna erat diam stet. Sadips duo stet amet amet ndiam elitr ipsum diam</p>
                                    <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp"
                                        href="#">Shop Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item position-relative" style="height: 430px;">
                            <img class="position-absolute w-100 h-100"
                                src="{{ asset('storage/categories/' . $categories[1]['image']['path']) }}"
                                style="object-fit: cover;">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">
                                        {{ $categories[1]['name'] }}</h1>
                                    <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Lorem rebum magna amet lorem
                                        magna erat diam stet. Sadips duo stet amet amet ndiam elitr ipsum diam</p>
                                    <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp"
                                        href="#">Shop Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item position-relative" style="height: 430px;">
                            <img class="position-absolute w-100 h-100"
                                src="{{ asset('storage/categories/' . $categories[2]['image']['path']) }}"
                                style="object-fit: cover;">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">
                                        {{ $categories[2]['name'] }}</h1>
                                    <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Lorem rebum magna amet lorem
                                        magna erat diam stet. Sadips duo stet amet amet ndiam elitr ipsum diam</p>
                                    <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp"
                                        href="#">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="product-offer mb-30" style="height: 200px;">
                    <img class="img-fluid" src="{{ asset('storage/products/' . $products[0]['images'][0]['path']) }}"
                        alt="">
                    <div class="offer-text">
                        <h6 class="text-white text-uppercase">Save 20%</h6>
                        <h3 class="text-white mb-3">Special Offer</h3>
                        <a href="" class="btn btn-primary">Shop Now</a>
                    </div>
                </div>
                <div class="product-offer mb-30" style="height: 200px;">
                    <img class="img-fluid" src="{{ asset('storage/products/' . $products[1]['images'][0]['path']) }}"
                        alt="">
                    <div class="offer-text">
                        <h6 class="text-white text-uppercase">Save 20%</h6>
                        <h3 class="text-white mb-3">Special Offer</h3>
                        <a href="" class="btn btn-primary">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->

    <!-- Featured Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5 pb-3">
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">Quality Product</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1>
                    <h5 class="font-weight-semi-bold m-0">Free Shipping</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">14-Day Return</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">24/7 Support</h5>
                </div>
            </div>
        </div>
    </div>
    <!-- Featured End -->

    <!-- Categories Start -->
    <div class="container-fluid pt-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span
                class="bg-secondary pr-3">Categories</span></h2>
        <div class="row px-xl-5 pb-3">
            @for ($i = 0; $i < (count($categories) > 8 ? 8 : count($categories)); $i++)
                <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                    <a class="text-decoration-none" href="">
                        <div class="cat-item d-flex align-items-center mb-4">
                            <div class="overflow-hidden" style="width: 150px;height: 100px;object-fit: cover;">
                                <img class="img-fluid"
                                    src="{{ asset('storage/categories/' . $categories[$i]['image']['path']) }}"
                                    alt="picture">
                            </div>
                            <div class="flex-fill pl-3">
                                <h6>{{ $categories[$i]['name'] }}</h6>
                                <small class="text-body">{{ $categories[$i]['products_count'] }} products</small>
                            </div>
                        </div>
                    </a>
                </div>
            @endfor
        </div>
    </div>
    <!-- Categories End -->

    <!-- Featured Product Start -->
    <div class="container-fluid pt-5 pb-3">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Featured
                Products</span></h2>
        <div class="row px-xl-5">
            @for ($i = 0; $i < (count($products) > 8 ? 8 : count($products)); $i++)
                @if ($products[$i]['status'] == 2 || $products[$i]['status'] == 4)
                    <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                        <div class="product-item bg-light mb-4">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100"
                                    src="{{ asset('storage/products/' . $products[$i]['images'][0]['path']) }}"
                                    alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square"
                                        onclick="function (){
                                    }" href=""><i
                                            class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                            class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                            class="fa fa-sync-alt"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                            class="fa fa-search"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate"
                                    href="">{{ $products[$i]['name'] }}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">

                                    @if ($products[$i]['discount_price'] != null)
                                        <h5>${{ $products[$i]['discount_price'] }}</h5>
                                        <h6 class="text-muted ml-2">
                                            <del>${{ $products[$i]['price'] }}</del>
                                        </h6>
                                    @else
                                        <h5>${{ $products[$i]['price'] }}</h5>
                                    @endif


                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small>({{ $products[$i]['order__details_count'] }})</small>
                                </div>
                                <small style="color: {{ $products[$i]['stock'] <= 100 ? 'red' : 'black' }}">
                                    {{ $products[$i]['stock'] }}
                                </small>
                            </div>
                        </div>
                    </div>
                @endif
            @endfor
        </div>
    </div>
    <!-- Featured Product End -->

    <!-- Offer Start -->
    <div class="container-fluid pt-5 pb-3">
        <div class="row px-xl-5">
            <?php
            $bol = 1;
            ?>
            @for ($i = 0; $i < count($products); $i++)
                @if ($bol < 3)
                    @if ($products[$i]['discount_price'] != null)
                        <?php
                        $bol++;
                        ?>
                        <div class="col-md-6">
                            <div class="product-offer mb-30" style="height: 300px;">
                                <img class="img-fluid"
                                    src="{{ asset('storage/products/' . $products[$i]['images'][0]['path']) }}"
                                    alt="sjdak">
                                <div class="offer-text">
                                    <h6 class="text-white text-uppercase">{{ $products[$i]['name'] }}</h6>
                                    <h3 class="text-white mb-3">Special Offer</h3>
                                    <a href="" class="btn btn-primary">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    @endif
                @else
                @break
            @endif
        @endfor

    </div>
</div>
<!-- Offer End -->

<!-- Populer Product Start -->
<?php
$populer = 1;
?>
<div class="container-fluid pt-5 pb-3">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Populer
            Products</span></h2>
    <div class="row px-xl-5">
        @for ($i = 0; $i < (count($products) > 8 ? 8 : count($products)); $i++)
            @if (($products[$i]['status'] == 3 || $products[$i]['status'] == 4) && $populer < 8)
                <?php
                $populer++;
                ?>
                <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                    <div class="product-item bg-light mb-4">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100"
                                src="{{ asset('storage/products/' . $products[$i]['images'][0]['path']) }}"
                                alt="">
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square"
                                    onclick="function (){
                                }" href=""><i
                                        class="fa fa-shopping-cart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i
                                        class="far fa-heart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i
                                        class="fa fa-sync-alt"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i
                                        class="fa fa-search"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate"
                                href="">{{ $products[$i]['name'] }}</a>
                            <div class="d-flex align-items-center justify-content-center mt-2">

                                @if ($products[$i]['discount_price'] != null)
                                    <h5>${{ $products[$i]['discount_price'] }}</h5>
                                    <h6 class="text-muted ml-2">
                                        <del>${{ $products[$i]['price'] }}</del>
                                    </h6>
                                @else
                                    <h5>${{ $products[$i]['price'] }}</h5>
                                @endif


                            </div>
                            <div class="d-flex align-items-center justify-content-center mb-1">
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small>({{ $products[$i]['order__details_count'] }})</small>
                            </div>
                            <small style="color: {{ $products[$i]['stock'] <= 100 ? 'red' : 'black' }}">
                                {{ $products[$i]['stock'] }}
                            </small>
                        </div>
                    </div>
                </div>
            @endif
        @endfor
    </div>
</div>
<!-- populer Product End -->

<!-- Best Sale Product Start -->
<div class="container-fluid pt-5 pb-3">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Best Sale
            Products</span></h2>
    <div class="row px-xl-5">
        @for ($i = 0; $i < count($products); $i++)
            @if ($products[$i]['order__details_count'] >= 5)
                <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                    <div class="product-item bg-light mb-4">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100"
                                src="{{ asset('storage/products/' . $products[$i]['images'][0]['path']) }}"
                                alt="">
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square"
                                    onclick="function (){
                                }" href=""><i
                                        class="fa fa-shopping-cart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i
                                        class="far fa-heart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i
                                        class="fa fa-sync-alt"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i
                                        class="fa fa-search"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate"
                                href="">{{ $products[$i]['name'] }}</a>
                            <div class="d-flex align-items-center justify-content-center mt-2">

                                @if ($products[$i]['discount_price'] != null)
                                    <h5>${{ $products[$i]['discount_price'] }}</h5>
                                    <h6 class="text-muted ml-2">
                                        <del>${{ $products[$i]['price'] }}</del>
                                    </h6>
                                @else
                                    <h5>${{ $products[$i]['price'] }}</h5>
                                @endif


                            </div>
                            <div class="d-flex align-items-center justify-content-center mb-1">
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small>({{ $products[$i]['order__details_count'] }})</small>
                            </div>
                            <small style="color: {{ $products[$i]['stock'] <= 100 ? 'red' : 'black' }}">
                                {{ $products[$i]['stock'] }}
                            </small>
                        </div>
                    </div>
                </div>
            @endif
        @endfor
    </div>
</div>
<!-- Best Sale  Product End -->


@endsection

@section('js')
{{-- 
    <script>
        function setProductCookie(product) {
            $.ajax({
                url: '/set-product-cookie', // Laravel route
                method: 'POST',
                data: {
                    product: product, // Send the new product to be added
                    _token: "{{ csrf_token() }}" // CSRF token for security
                },
                success: function(response) {
                    if (response.success) {
                        console.log('Product added to cookie:', response.products);
                    }
                },
                error: function(error) {
                    console.log('Error setting product cookie:', error);
                }
            });
        }
    </script> --}}

@endsection
