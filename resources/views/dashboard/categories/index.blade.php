@extends('layouts.dashboard')

@section('page-title', 'All Categories')


@section('content')
    @include('alert')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3>All Categories</h3>
                    </div>
                    <div class="card-body">
                        <table id="categories-table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>FEATC..</th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Activity</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>
                                            <form action="{{ route('category.status', $category) }}" method="POST"
                                                id="popular-form{{$loop->index}}">
                                                @csrf
                                                <input type="hidden" name="regular_status" value="1">
                                                <input type="checkbox" value="2"
                                                    {{ $category->status == 2 ? 'checked' : null }} name="status"
                                                    id="popular{{$loop->index}}" onclick="document.getElementById('popular-form{{$loop->index}}').submit()">
                                                <label for="popular{{$loop->index}}">{{ $category->status == 2 ? 'ON' : 'OFF' }}</label>
                                            </form>
                                        </td>
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->created_at->diffForHumans() }}</td>
                                        <td>{{ $category->updated_at->diffForHumans() }}</td>
                                        <td>
                                            <form action="{{ route('category.status', $category) }}" method="POST"
                                                id="activity-form{{$loop->index}}">
                                                @csrf
                                                <div class="custom-control custom-switch">

                                                    <input type="checkbox" class="custom-control-input" value="1"
                                                        {{ $category->status >= 1 ? 'checked' : null }} name="status"
                                                        id="customSwitch1{{$loop->index}}" onclick="document.getElementById('activity-form{{$loop->index}}').submit()">
                                                    <label class="custom-control-label"
                                                        for="customSwitch1{{$loop->index}}">{{ $category->status == true ? 'Active' : 'Inactive' }}</label>
                                                </div>
                                            </form>
                                        </td>
                                        <td>
                                            <a href="{{ route('categories.edit', $category) }}"
                                                class="btn btn-primary">Edit</a>
                                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                                style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Feat..</th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Activity</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#categories-table').DataTable();
        });
    </script>
    <script src="{{ asset('dashboard/js/category.js') }}"></script>
    <script>
        let check = document.getElementById('customSwitch1');
        let form = document.getElementById('activity-form');
        let popular_form = document.getElementById('popular-form');
        let popular_checkbox = document.getElementById('popular');

        // check.onclick = function() {
        //     form.submit();
        // }

        // popular_checkbox.onclick = function () {
        //     if (popular_checkbox.value == "2") {
        //         popular_form.submit();
        //     }else {
        //         popular_checkbox.value =  "1";
        //         popular_form.submit();
        //     }          
        // }
    </script>
@endsection
