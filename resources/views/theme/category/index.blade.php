@extends('layouts.theme')

@section('page-title', 'All Category')

@section('content')

    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5 ">
            <!-- Shop Product Start -->
            <div class="container-fluid pt-5">
                <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span
                        class="bg-secondary pr-3">Categories</span></h2>
                <div class="row px-xl-5 pb-3">
                    @foreach ($categories as $category)
                        <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                            <a class="text-decoration-none" href="{{ route('category.show', $category) }}">
                                <div class="cat-item d-flex align-items-center mb-4">
                                    <div class="overflow-hidden" style="width: 150px;height: 100px;object-fit: cover;">
                                        <img class="img-fluid"
                                            src="{{ asset('storage/categories/' . $category->image->path) }}"
                                            alt="picture">
                                    </div>
                                    <div class="flex-fill pl-3">
                                        <h6>{{ $category->name }}</h6>
                                        <small class="text-body">{{ $category->products_count }} products</small>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
        <!-- Shop End -->
    @endsection
