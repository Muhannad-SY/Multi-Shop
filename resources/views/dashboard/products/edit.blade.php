@extends('layouts.dashboard')

@section('page-title', 'Create Product')

@section('content')
    @include('errors')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Create New Product Form</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('product.update', $product->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="exampleInputEmail1">Product Name</label>
                                <input type="text" class="form-control" value="{{ $product->name }}" name="name"
                                    required id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Product Descraption</label>
                                <textarea rows="2" type="text" class="form-control" 
                                    name="description" required id="exampleInputPassword1">{{ $product->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1t">Product Inside-Descraption</label>
                                <textarea type="text" class="form-control" rows="5" name="in_description" 
                                required id="exampleInputPassword1t">{{ $product->in_description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Product Price</label>
                                <input type="number" class="form-control" value="{{ $product->price }}" name="price"
                                    required id="exampleInputPassword1">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Product Dis-Count Price</label>
                                <input type="number" class="form-control" value="{{$product->discount_price}}" 
                                    name="discount_price" id="exampleInputPassword1">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Product Stock</label>
                                <input type="text" class="form-control" value="{{ $product->stock }}" name="stock"
                                    required id="exampleInputPassword1">
                            </div>
                            <div class="form-group form-check">
                                <input type="file" class="form-control" name="product_images[]" id="exampleCheck1"
                                    accept="image/*" multiple>
                            </div>
                            <br><br>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($product->images as $image)
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <img src="{{ asset('storage/products/' . $image->path) }}" alt="prpoduct Image"
                                class="card-img-top">
                            <p class="card-text"></p>
                            <form action="{{ route('delete.one.product', $image) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                {{-- @method('DELETE') --}}
                                <input type="submit" value="Delete Image" class="btn btn-danger" style="width:100%">
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
