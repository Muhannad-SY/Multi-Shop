@extends('layouts.dashboard')



@section('page-title', 'All Reviews')

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
                        <h3 class="card-title">All Reviews</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="review" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Body</th>
                                    <th>Stars</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reviews as $review)
                                    <tr>
                                        <td>{{ $review->id }}</td>
                                        <td>{{ $review->body}}</td>
                                        <td>@for ($i = 0; $i < $review->stars; $i++)
                                            <span class="material-symbols-outlined"
                                             style="color: yellow;">
                                            star
                                            </span>
                                        @endfor
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
                $('#review').DataTable();
            });
        </script>
    @endsection
