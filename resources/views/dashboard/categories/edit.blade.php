@extends('layouts.dashboard')

@section('page-title', 'Edit Category')

@section('content')

    @include('errors')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        Edit Category
                    </div>
                    <div class="card-body">
                        <form action="{{route('categories.update',$category->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                              <label for="name">Category name</label>
                              <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="{{$category->name}}" required>
                            </div>
                            <div class="form-group">
                                <label for="image">Category Image</label>
                                <input type="file" class="form-control-file" name="category_picture" id="image" accept="image/*">
                              </div>
                            <button type="submit" class="btn btn-success">Save</button>
                          </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        Category Image
                    </div>
                    <div class="card-body text-center">
                        <img src="{{asset('storage/categories/'.$category->image->path)}}" alt="Category Image" class="img-fluid w-50">
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection