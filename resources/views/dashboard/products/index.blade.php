@extends('layouts.dashboard')



@section('page-title', 'All Products')

@section('content')
    @include('alert')
    <!-- Main content -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">All Products</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="products" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Status</th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Activity</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>
                                            <form action="{{ route('product.status', $product) }}" method="POST"
                                                id="featured-product-form{{ $loop->index }}">
                                                @csrf
                                                <input type="hidden" name="dis" value="2">
                                                <input type="checkbox" value="2"
                                                    {{ $product->status == 2 || $product->status == 4 ? 'checked' : null }}
                                                    name="status" id="featuerd{{ $loop->index }}"
                                                    onclick="document.getElementById('featured-product-form{{ $loop->index }}').submit()">
                                                <label for="featuerd{{ $loop->index }}">Featured</label>
                                            </form>
                                            <form action="{{ route('product.status', $product) }}" method="POST"
                                                id="popular-product-form{{ $loop->index }}">
                                                @csrf
                                                <input type="hidden" name="dis" value="3">
                                                <input type="checkbox" value="3"
                                                    {{ $product->status == 3 || $product->status == 4 ? 'checked' : null }}
                                                    name="status" id="popular{{ $loop->index }}"
                                                    onclick="document.getElementById('popular-product-form{{ $loop->index }}').submit()">
                                                <label for="popular{{ $loop->index }}">Popular</label>
                                            </form>
                                        </td>
                                        <td>{{ $product->id }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->category->name }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>{{ $product->stock }}</td>
                                        <td>
                                          <form action="{{ route('product.status', $product) }}" method="POST"
                                              id="activity-form{{$loop->index}}">
                                              @csrf
                                              <div class="custom-control custom-switch">
                                                <input type="hidden" name="dis" value="0">
                                                  <input type="checkbox" class="custom-control-input" value="1"
                                                      {{ $product->status >= 1 ? 'checked' : null }} name="status"
                                                      id="customSwitch1{{$loop->index}}" onclick="document.getElementById('activity-form{{$loop->index}}').submit()">
                                                  <label class="custom-control-label"
                                                      for="customSwitch1{{$loop->index}}">{{ $product->status == true ? 'Active' : 'Inactive' }}</label>
                                              </div>
                                          </form>

                                      </td>
                                        <td>
                                            <a href="{{ route('product.edit', $product->id) }}"
                                                class="btn btn-primary">Edit</a>
                                            <form action="{{ route('product.destroy', $product->id) }}" method="POST"
                                                style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>


                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->



    @endsection

    @section('scripts')
        <script>
            $(document).ready(function() {
                $('#products').DataTable();
            });
        </script>
    @endsection
