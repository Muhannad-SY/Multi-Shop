<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>MultiShop - @yield('page-title')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="{{ asset('theme/img/favicon.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('theme/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('theme/css/style.css') }}" rel="stylesheet">
    {{-- Google Icons --}}
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=person" />
    @yield('css')
    <style>
        .show-search-box {
            position: absolute;
            top: 40px;
            margin: 0;
            padding: 15px;
            width: 90%;
            height: auto;
            background-color: rgb(250, 249, 249);
            z-index: 10;

        }

        .list-group-item {
            padding: 0;
            border: 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.125);
        }

        .list-group-item:hover {
            background-color: rgb(241, 237, 237);
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row bg-secondary py-1 px-xl-5">
            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center d-block d-lg-none">

                    <a href="{{ route('cart.index') }}" class="btn px-0 ml-2">
                        <i class="fas fa-shopping-cart text-dark"></i>
                        <span class="badge text-dark border border-dark rounded-circle"
                            style="padding-bottom: 2px;">{{ count($cart['products'] ?? []) }}</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
            <div class="col-lg-4">
                <a href="{{ route('home') }}" class="text-decoration-none">
                    <span class="h1 text-uppercase text-primary bg-dark px-2">Multi</span>
                    <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">Shop</span>
                </a>
            </div>
            <div class="col-lg-4 col-6 text-left">
                
                    <div class="input-group">
                        <input type="text" class="form-control" id="search-bar" name="search"
                            placeholder="Search for products">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent text-primary">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                    </div>
                
                <div id="search-results" class=""></div>
            </div>
            <div class="col-lg-4 col-6 text-right">
                <p class="m-0">Customer Service</p>
                <h5 class="m-0">+90 539 407 8535</h5>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid bg-dark mb-30">
        <div class="row px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn d-flex align-items-center justify-content-between bg-primary w-100" data-toggle="collapse"
                    href="#navbar-vertical" style="height: 65px; padding: 0 30px;">
                    <h6 class="text-dark m-0"><i class="fa fa-bars mr-2"></i>Categories</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 bg-light"
                    id="navbar-vertical" style="width: calc(100% - 30px); z-index: 999;">
                    <div class="navbar-nav w-100">
                        @foreach ($categories as $category)
                            <a href="{{ route('category.show', $category) }}"
                                class="nav-item nav-link">{{ $category->name }}</a>
                        @endforeach
                    </div>
                </nav>
            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <span class="h1 text-uppercase text-dark bg-light px-2">Multi</span>
                        <span class="h1 text-uppercase text-light bg-primary px-2 ml-n1">Shop</span>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="{{ route('home') }}"
                                class="nav-item nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                            <a href="{{ route('products.shop') }}"
                                class="nav-item nav-link {{ request()->routeIs('products.shop', 'category.show') ? 'active' : '' }}">Shop</a>
                            <a href="{{ route('category.shop') }}"
                                class="nav-item nav-link {{ request()->routeIs('category.shop') ? 'active' : '' }}">Categories</a>


                        </div>
                        <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                            <a href="{{ route('cart.index') }}" class="btn px-0 ml-3">
                                <i class="fas fa-shopping-cart text-primary"></i>
                                <span class="badge text-secondary border border-secondary rounded-circle"
                                    id="cart-item-counter"
                                    style="padding-bottom: 2px;">{{ count($cart['products'] ?? []) }}</span>
                            </a>

                        </div>
                        <div>
                            @guest
                                @if (Route::has('login'))
                                    <a class="nav-link" href="{{ route('login') }}"><span style="margin-top: 5px"
                                            class="material-symbols-outlined">
                                            person
                                        </span></a>
                                @endif
                            @else
                                <ul class="navbar-nav ml-auto">
                                    <li class="nav-item dropdown">
                                        <a class="nav-link" data-toggle="dropdown" href="#">
                                            {{ Auth::user()->name }}
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="{{ route('customer.all.orders') }}" class="dropdown-item">
                                                My Orders
                                            </a>
                                            <a href="{{ route('address.index') }}" class="dropdown-item">
                                                Addresses
                                            </a>
                                            <a href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                                 document.getElementById('logout-form').submit();"
                                                class="dropdown-item">
                                                Logout
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                class="d-none">
                                                @csrf
                                            </form>

                                        </div>
                                    </li>
                                </ul>
                            @endguest

                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->

    @yield('content')

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-secondary mt-5 pt-5">
        <div class="row px-xl-5 pt-5">
            <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
                <h5 class="text-secondary text-uppercase mb-4">Get In Touch</h5>
                <p class="mb-4">No dolore ipsum accusam no lorem. Invidunt sed clita kasd clita et et dolor sed
                    dolor. Rebum tempor no vero est magna amet no</p>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123 zafer.MH, Istanbul, Turke
                </p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>info@example.com</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>+90 539 407 8535</p>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">Quick Shop</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-secondary mb-2" href="#"><i
                                    class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Our
                                Shop</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Shop
                                Detail</a>
                            <a class="text-secondary mb-2" href="#"><i
                                    class="fa fa-angle-right mr-2"></i>Shopping Cart</a>
                            <a class="text-secondary mb-2" href="#"><i
                                    class="fa fa-angle-right mr-2"></i>Checkout</a>
                            <a class="text-secondary" href="#"><i class="fa fa-angle-right mr-2"></i>Contact
                                Us</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">My Account</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-secondary mb-2" href="#"><i
                                    class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-secondary mb-2" href="#"><i
                                    class="fa fa-angle-right mr-2"></i>Shopping Cart</a>
                            <a class="text-secondary" href="#"><i class="fa fa-angle-right mr-2"></i>Contact
                                Us</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">Newsletter</h5>
                        <p>Duo stet tempor ipsum sit amet magna ipsum tempor est</p>
                        <form action="">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Your Email Address">
                                <div class="input-group-append">
                                    <button class="btn btn-primary">Sign Up</button>
                                </div>
                            </div>
                        </form>
                        <h6 class="text-secondary text-uppercase mt-4 mb-3">Follow Us</h6>
                        <div class="d-flex">
                            <a class="btn btn-primary btn-square mr-2"
                                href="https://x.com/aledlebe43256?t=HXd8nnNKo4gt5Mx13c8YZw&s=09"><i
                                    class="fab fa-twitter"></i></a>
                            <a class="btn btn-primary btn-square mr-2"
                                href="https://www.facebook.com/beki.sanchez.9/"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-primary btn-square mr-2"
                                href="https://www.linkedin.com/in/muhannad-abdulhai-0b682a2bb/"><i
                                    class="fab fa-linkedin-in"></i></a>
                            <a class="btn btn-primary btn-square" href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row border-top mx-xl-5 py-4" style="border-color: rgba(256, 256, 256, .1) !important;">
            <div class="col-md-6 px-xl-0">
                <p class="mb-md-0 text-center text-md-left text-secondary">
                    &copy; <a class="text-primary" href="#">Domain</a>. All Rights Reserved. Designed
                    by
                    <a class="text-primary" href="https://htmlcodex.com">HTML Codex</a>
                </p>
                <div class="col-md-6 px-xl-0 text-center text-md-right">
                    <img class="img-fluid" src="img/payments.png" alt="">
                </div>
            </div>
        </div>
        <!-- Footer End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('theme/lib/easing/easing.min.js') }}"></script>
        <script src="{{ asset('theme/lib/owlcarousel/owl.carousel.min.js') }}"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

        <!-- Contact Javascript File -->
        <script src="{{ asset('theme/mail/jqBootstrapValidation.min.js') }}"></script>
        <script src="{{ asset('theme/mail/contact.js') }}"></script>

        <!-- Template Javascript -->
        <script src="{{ asset('theme/js/main.js') }}"></script>
        @yield('js')

        <script>
            $(document).ready(function() {
                $('#search-bar').on('input', function() {
                    let query = $(this).val();

                    if (query.length > 2) {
                        $.ajax({
                            url: "{{ route('type.search') }}",
                            type: "GET",
                            data: {
                                _token: '{{ csrf_token() }}',
                                search: query
                            },
                            success: function(response) {
                                let resultsHtml = '<div class=" show-search-box">';

                                // Categories section
                                if (response.categories.length > 0) {
                                    resultsHtml +=
                                        `<h5 class="mt-1">Categories</h5><ul class="list-group">`;

                                    response.categories.forEach(category => {
                                        let actionUrl =
                                            "{{ route('search.category.show', ':id') }}"
                                            .replace(':id', category.id);

                                        resultsHtml += `
                                    <a href="${actionUrl}">
                                        <li class="list-group-item">
                                            <strong>${category.name}</strong><br>
                                        </li>
                                    </a>
                            `;
                                    });
                                    resultsHtml += `</ul>`;
                                }

                                // Products section
                                if (response.products.length > 0) {
                                    resultsHtml +=
                                        `<h5 class="mt-4">Products</h5><ul class="list-group">`;

                                    response.products.forEach(product => {
                                        let actionUrl =
                                            "{{ route('search.product.show', ':id') }}"
                                            .replace(':id', product.id);

                                        resultsHtml += `
                                            <a href="${actionUrl}">
                                                <li class="list-group-item">
                                                    <strong>${product.name}</strong><br>
                                                </li>
                                            </a>
                                        `;
                                    });
                                    resultsHtml += `</ul>`;
                                }
                                resultsHtml += `</div>`;
                                // Show the results or display a "No results" message
                                if (resultsHtml === '') {
                                    resultsHtml =
                                        '<li class="list-group-item">No results found.</li>';
                                }

                                $('#search-results').html(resultsHtml).show();
                            }
                        });
                    } else {
                        $('#search-results').hide();
                    }
                });
                $(document).on('click', function(e) {
                    if (!$(e.target).closest('#search-bar, #search-results').length) {
                        $('#search-results').hide();
                    }
                });
            })
        </script>
</body>

</html>
