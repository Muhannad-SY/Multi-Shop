@extends('layouts.dashboard')



@section('page-title', 'Panding Reviews')

@section('css')
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=star" />
@endsection
@section('content')
    @include('alert')
    <!-- Main content -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Panding Reviews</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="review" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Body</th>
                                    <th>Stars</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pandings as $panding)
                                    <tr>
                                        <td>{{ $panding->id }}</td>
                                        <td>{{ $panding->body}}</td>
                                        <td>@for ($i = 0; $i < $panding->stars; $i++)
                                            <span class="material-symbols-outlined"
                                             style="color: yellow;">
                                            star
                                            </span>
                                        @endfor
                                        </td>
                                        <td>
                                            <form action="{{route('review.accept' , $panding->id)}}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-primary">Accept</button>
                                            </form>
                                            <form action="{{route('review.delete' , $panding->id)}}" method="POST">
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
                </div>
            </div>
        </div>


    @endsection

    @section('scripts')
        <script>
            $(document).ready(function() {
                $('#review').DataTable();
            });
        </script>
    @endsection
