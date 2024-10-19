@extends('layouts.theme')

@section('page-title', 'Addresses')

@section('content')


    <!-- Single Page Header End -->
    @include('alert')
    <div class="container my-5">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <h4 class="card-title">Addresses</h4>
                            </div>
                            <div class="col-lg-6 text-end">
                                <button class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#createAdressModal">Add Address</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Def-Ad</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Zip Code</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($addresses as $address)
                                    <tr>
                                        <td>
                                            <form action="{{ route('make.address.default', $address) }}" method="post" id="put-def-form{{$loop->index}}">
                                                @csrf
                                                <input type="checkbox" value="1" {{$address->default_address == 1 ? 'checked' : ''}} name="default_address" id="def-loc-btn" onclick="document.getElementById('put-def-form{{$loop->index}}').submit()">
                                                <label for="def-loc-btn">def</label>
                                            </form>
                                        </td>
                                        <td>{{ $address->adreess }}</td>
                                        <td>{{ $address->zip_code }}</td>
                                        <td>{{ $address->title }}</td>
                                        <td>
                                            <button class="btn btn-warning btn-sm" id="editBtn{{ $loop->index }}"
                                                data-bs-toggle="modal"
                                                onclick="$(document).ready(function() {var url = '{{ env('APP_URL') }}';$('#editBtn{{ $loop->index }}').click(function(){ var address=$(this).data('address');$('#edit_adreess').val(address.adreess);$('#edit_zip_code').val(address.zip_code);$('#edit_title').val(address.title); $('#editForm').attr('action',url+'address/'+address.id);});});"
                                                data-bs-target="#editAdressModal"
                                                data-address="{{ $address }}">Edit</button>
                                            <form action="{{ route('address.destroy', $address->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
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
    </div>

    <!-- Modal -->
    <div class="modal fade" id="createAdressModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create New Address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('address.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="adreess" class="form-label">Address</label>
                            <input type="text" class="form-control" id="adreess" name="adreess" placeholder="Address"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="zip_code" class="form-label">Zip Code</label>
                            <input type="text" class="form-control" id="zip_code" name="zip_code" placeholder="Zip Code"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Title"
                                required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="editAdressModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#" method="POST" id="editForm">
                    @method('PUT')
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit_adreess" class="form-label">Address</label>
                            <input type="text" class="form-control" id="edit_adreess" name="adreess"
                                placeholder="Address" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_zip_code" class="form-label">Zip Code</label>
                            <input type="text" class="form-control" id="edit_zip_code" name="zip_code"
                                placeholder="Zip Code" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="edit_title" name="title"
                                placeholder="Title" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('.alert_action').fadeOut(5000);

        
        });
    </script>
@endsection
