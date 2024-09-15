@extends('layouts.dashboard')



@section('page-title' , 'All Products')
    
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
                  <th>ID</th>
                  <th>Name</th>
                  <th>Category</th>
                  <th>Price</th>
                  <th>Stock</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                 <tr>
                    <td>{{$product->id}}</td>
                    <td>{{$product->name}}</td>
                    <td>{{$product->category->name}}</td>
                    <td>{{$product->price}}</td>
                    <td>{{$product->stock}}</td>
                    <td>
                        <a href="{{ route('product.edit', $product->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('product.destroy', $product->id) }}" method="POST" style="display: inline-block;">
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
