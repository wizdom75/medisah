@extends('layouts.app')

@section('title', 'Users')

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
            <!-- <button type="button" class="btn btn-primary waves-effect waves-light btn-lg" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">New @yield('title')</button> -->
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
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Subdomain</th>
                                <th>Role</th>
                                <th>Job title</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                                <tr data-id="1">
                                    <td data-field="id" style="width: 80px">{{ $user->id }}</td>
                                    <td data-field="name">{{ $user->name }}</td>
                                    <td data-field="email">{{ $user->email }}</td>
                                    <td data-field="phone">{{ $user->phone }}</td>
                                    <td data-field="sku">{{ $user->merchant->name }}</td>
                                    <td data-field="sku">{{ $user->role }}</td>
                                    <td data-field="sku">{{ $user->job_title }}</td>
                                    <td style="width: 100px">
                                        <a class="btn btn-outline-secondary btn-sm edit" title="Edit"  data-bs-toggle="modal" data-bs-target=".bs-update-modal-lg-{{ $user->id }}">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <!-- Form -->
                                        <div class="modal fade bs-update-modal-lg-{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title mt-0" id="myLargeModalLabel">Update user</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="custom-validation" action=" {{ route('users.update', $user) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="row">
                                                                <div class="mb-3 col-md-12">
                                                                    <label class="form-label">Name</label>
                                                                    <input name="name" type="text" class="form-control form-control-lg" disabled value="{{ $user->name }}"/>
                                                                </div>

                                                                <div class="mb-3 col-md-6">
                                                                    <label class="form-label">Email</label>
                                                                    <input name="email" type="text" class="form-control form-control-lg" disabled value="{{ $user->email }}"/>
                                                                </div>
                                                                <div class="mb-3 col-md-6">
                                                                    <label class="form-label">Phone</label>
                                                                    <input name="phone" type="text" class="form-control form-control-lg" disabled value="{{ $user->phone }}"/>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="mb-3 col-md-4">
                                                                    <label class="form-label" for="job_title">Job title</label>
                                                                    <div>
                                                                        <select name="job_title" id="job_title" class="form-control form-control-lg">
                                                                            <option value="Manager" @if($user->job_title == 'Manager') selected @endif > Manager</option>
                                                                            <option value="Cashier" @if($user->job_title == 'Cashier') selected @endif >Cashier</option>
                                                                            <option value="Director" @if($user->job_title == 'Director') selected @endif > Director</option>
                                                                            <option value="Accountant" @if($user->job_title == 'Accountant') selected @endif >Accountant</option>
                                                                        </select>
                                                                    </div>
                                                                    
                                                                </div>
                                                                <div class="mb-3 col-md-4">
                                                                    <label class="form-label" for="role">Role</label>
                                                                    <div>
                                                                        <select name="role" id="role" class="form-control form-control-lg">
                                                                            <option value="Owner" @if($user->role == 'Owner') selected @endif> Owner</option>
                                                                            <option value="Superadmin" @if($user->role == 'Superadmin') selected @endif>Superadmin</option>
                                                                            <option value="User" @if($user->role == 'User') selected @endif> User</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3 col-md-4">
                                                                    <label class="form-label">Subdomain</label>
                                                                    <div>
                                                                        <input name="merchant" parsley-type="text" type="text" class="form-control form-control-lg" value="{{ $user->merchant->name }}" disabled/>
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
                                        <form action=" {{ route('users.destroy', $user->id) }}" method="post" class="" style="display:inline">
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
                                        <h1 class="text-center">No users found</h1>
                                    </td>
                                </tr>
                            @endforelse
                            <tr>
                                <td colspan="8">
                                    {{ $users->onEachSide(1)->links() }}
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
                <h5 class="modal-title mt-0" id="myLargeModalLabel">Add item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <form class="custom-validation" action=" {{ route('users.store') }}">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Name</label>
                            <input name="name" type="text" class="form-control form-control-lg" required placeholder="Type something"/>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label">Category</label>
                            <div>
                                <select name="category" type="text" id="category" class="form-control form-control-lg" required
                                        placeholder="Password">
                                        <option value="0">None</option>
                                        <option value="1">Test category</option>
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <div>
                            <textarea name="description" type="description" class="form-control form-control-lg" required
                                    parsley-type="text" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-4">
                            <label class="form-label">GTIN</label>
                            <div>
                                <input name="gtin" parsley-type="text" type="text" class="form-control form-control-lg" />
                            </div>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label class="form-label">SKU</label>
                            <div>
                                <input name="sku" data-parsley-type="text" type="text"
                                        class="form-control form-control-lg" required
                                        placeholder=""/>
                            </div>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label class="form-label">Unit</label>
                            <div>
                                <select name="unit" id="unit" class="form-control form-control-lg">
                                    <option value="item"> Per Item</option>
                                    <option value="litre">Per litre</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label class="form-label">Price</label>
                            <div>
                                <input data-parsley-type="alphanum" type="text"
                                        class="form-control form-control-lg" required
                                        placeholder="Enter alphanumeric value"/>
                            </div>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label class="form-label">Unit cost</label>
                            <div>
                            <input data-parsley-type="alphanum" type="text"
                                        class="form-control form-control-lg" required
                                        placeholder="Enter alphanumeric value"/>
                            </div>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label class="form-label">Stock</label>
                            <div>
                            <input data-parsley-type="alphanum" type="text"
                                        class="form-control form-control-lg" required
                                        placeholder="Enter alphanumeric value"/>
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
