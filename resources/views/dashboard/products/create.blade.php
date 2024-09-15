@extends('layouts.dashboard')

@section('page-title', 'Create Product')

@section('content')
    @include('errors')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Create New Product</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Product Name</label>
                                <input type="text" class="form-control" value="{{ old('name') }}" name="name"
                                    required id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Product Descraption</label>
                                <textarea type="text" class="form-control" rows="5"
                                    name="description" required id="exampleInputPassword1">{{ old('description') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Product Price</label>
                                <input type="number" class="form-control"  value="{{ old('price') }}" name="price"
                                    required id="exampleInputPassword1">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Product Stock</label>
                                <input type="text" class="form-control" value="{{ old('stock') }}" name="stock"
                                    required id="exampleInputPassword1">
                            </div>
                            <div class="form-group">
                                <label for="category_id">Related To Category Name</label> 
                                <select class="form-control" name="category_id" required id="category_id">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group"> 
                                <input type="file" class="form-control" name="product_images[]" required
                                    id="exampleCheck1" accept="image/*" multiple>
                            </div>
                            <br><br>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
