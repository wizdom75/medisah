@extends('layouts.app')

@section('title', 'Suppliers')

@section('content')
<div class="row">
    <div class="col-sm-6">
        <div class="page-title-box">
            <h4> @yield('title') </h4>
            @include('partials.breadcrumb')
        </div>
    </div>
    <div class="col-sm-6">
        <div class="state-information d-none d-sm-block">
            <div class="state-graph">
            <button type="button" class="btn btn-primary waves-effect waves-light btn-lg" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">+ supplier</button>
            </div>
        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <!-- <h4 class="card-title">Table Edits</h4>
                <p class="card-title-desc">Table Edits is a lightweight jQuery plugin for making table rows editable.</p> -->

                <div class="table-responsive">
                    <table class="table table-editable table-nowrap align-middle table-edits">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Contact person</th>
                                <th>email</th>
                                <th>phone</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($suppliers as $supplier)
                            <tr data-id="1">
                                <td data-field="id" style="width: 80px"> {{ $supplier->id }}</td>
                                <td data-field="name">{{ $supplier->name }}</td>
                                <td data-field="name">{{ $supplier->contact_name }}</td>
                                <td data-field="name">{{ $supplier->contact_email }}</td>
                                <td data-field="name">{{ $supplier->contact_phone }}</td>
                                <td style="width: 100px">
                                    <a class="btn btn-outline-secondary btn-sm edit" title="Edit"  data-bs-toggle="modal" data-bs-target=".bs-update-modal-lg-{{ $supplier->id }}">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <!-- Update modal -->
                                    <div class="modal fade bs-update-modal-lg-{{ $supplier->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Update supplier</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="custom-validation" action=" {{ route('suppliers.update', $supplier) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="row">
                                                            <div class="mb-3 col-md-12">
                                                                <label class="form-label">Company Name</label>
                                                                <input name="name" type="text" class="form-control form-control-lg" required value="{{ $supplier->name }}"/>
                                                            </div>

                                                            <div class="mb-3 col-md-4">
                                                                <label class="form-label">Address line 1</label>
                                                                <div>
                                                                    <input type="text" class="form-control form-control-lg" name="address_line_1" value="{{ $supplier->address_line_1 }}">
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 col-md-4">
                                                                <label class="form-label">Address line 2</label>
                                                                <div>
                                                                    <input type="text" class="form-control form-control-lg" name="address_line_2" value="{{ $supplier->address_line_2 }}">
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 col-md-2">
                                                                <label class="form-label">Town/City</label>
                                                                <div>
                                                                    <input type="text" class="form-control form-control-lg" name="city" value="{{ $supplier->city }}">
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 col-md-2">
                                                                <label class="form-label">Post code</label>
                                                                <div>
                                                                    <input type="text" class="form-control form-control-lg" name="postcode" value="{{ $supplier->postcode }}">
                                                                </div>
                                                            </div>

                                                            <div class="mb-3 col-md-4">
                                                                <label class="form-label">Contact person</label>
                                                                <div>
                                                                    <input type="text" class="form-control form-control-lg" name="contact_name" value="{{ $supplier->contact_name }}">
                                                                </div>
                                                            </div>

                                                            <div class="mb-3 col-md-4">
                                                                <label class="form-label">Contact email</label>
                                                                <div>
                                                                    <input type="text" class="form-control form-control-lg" name="contact_email" value="{{ $supplier->contact_email }}">
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 col-md-4">
                                                                <label class="form-label">Contact phone</label>
                                                                <div>
                                                                    <input type="text" class="form-control form-control-lg" name="contact_phone" value="{{ $supplier->contact_phone }}">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary waves-effect waves-light me-1 btn-lg">Update </button>
                                                            <button type="reset" class="btn btn-secondary btn-lg" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div> <!-- end col -->
                                        <!-- /.modal-dialog -->
                                    </div>
                                    <form action=" {{ route('suppliers.destroy', $supplier->id) }}" method="post" class="" style="display:inline">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" onclick="return confirm('Are you sure.')" class="btn btn-outline-danger btn-sm mr-2" style="display:inline">
                                            <i class="fas fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                                <tr>
                                    <td colspan="3">
                                        <h1 class="text-center">No suppliers found</h1>
                                    </td>
                                </tr>
                        @endforelse
                            <tr>
                                <td colspan="6">
                                    {{ $suppliers->onEachSide(1)->links() }}
                                </td>
                            </tr>
                        </tbody>
                        </table>
                </div>

            </div>
        </div>
    </div> <!-- end col -->
</div> 
<!-- end row -->
<!-- Form -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel">Add a supplier</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <form class="custom-validation" action=" {{ route('suppliers.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label class="form-label">Company Name</label>
                            <input name="name" type="text" class="form-control form-control-lg" required placeholder=""/>
                        </div>

                        <div class="mb-3 col-md-4">
                            <label class="form-label">Address line 1</label>
                            <div>
                                <input type="text" class="form-control form-control-lg" name="address_line_1">
                            </div>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label class="form-label">Address line 2</label>
                            <div>
                                <input type="text" class="form-control form-control-lg" name="address_line_2">
                            </div>
                        </div>
                        <div class="mb-3 col-md-2">
                            <label class="form-label">Town/City</label>
                            <div>
                                <input type="text" class="form-control form-control-lg" name="city">
                            </div>
                        </div>
                        <div class="mb-3 col-md-2">
                            <label class="form-label">Post code</label>
                            <div>
                                <input type="text" class="form-control form-control-lg" name="postcode">
                            </div>
                        </div>

                        <div class="mb-3 col-md-4">
                            <label class="form-label">Contact person</label>
                            <div>
                                <input type="text" class="form-control form-control-lg" name="contact_name">
                            </div>
                        </div>

                        <div class="mb-3 col-md-4">
                            <label class="form-label">Contact email</label>
                            <div>
                                <input type="text" class="form-control form-control-lg" name="contact_email">
                            </div>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label class="form-label">Contact phone</label>
                            <div>
                                <input type="text" class="form-control form-control-lg" name="contact_phone">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary waves-effect waves-light me-1 btn-lg">Save </button>
                        <button type="reset" class="btn btn-secondary btn-lg" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>

            </div>
        </div>
    </div> <!-- end col -->
    <!-- /.modal-dialog -->
</div>
@endsection