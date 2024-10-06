@extends('layouts.dashboard')

@section('page-title', 'Create Category')

@section('content')

    @include('errors')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        Create Category
                    </div>
                    <div class="card-body">
                        <form action="{{route('categories.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                              <label for="name">Category name</label>
                              <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="{{old('name')}}" required>
                            </div>
                            <div class="form-group">
                                <label for="image">Category Image</label>
                                <input type="file" class="form-control-file" name="category_picture" id="image" accept="image/*" required>
                              </div>
                              <input type="hidden" name="status" value="1">
                            <button type="submit" class="btn btn-success">Create</button>
                          </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection