@extends('layouts.app')

@section('title', 'Categories')

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
            <button type="button" class="btn btn-primary waves-effect waves-light btn-lg" data-bs-toggle="modal" data-bs-target=".bs-example-modal-md">+ category</button>
            </div>
        </div>
    </div>
</div>

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
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $category)
                            <tr data-id="1">
                                <td data-field="id" style="width: 80px"> {{ $category->id }}</td>
                                <td data-field="name">{{ $category->name }}</td>
                                <td style="width: 100px">
                                <a class="btn btn-outline-secondary btn-sm edit" title="Edit"  data-bs-toggle="modal" data-bs-target=".bs-update-modal-lg-{{ $category->id }}">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <!-- Form -->
                                <div class="modal fade bs-update-modal-lg-{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-md modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title mt-0" id="myLargeModalLabel">Update category</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form class="custom-validation" action=" {{ route('categories.update', $category) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="row">
                                                        <div class="mb-3 col-12">
                                                            <label class="form-label">Name</label>
                                                            <input name="name" type="text" class="form-control form-control-lg" required value="{{ $category->name }}"/>
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

                                <form action=" {{ route('categories.destroy', $category->id) }}" method="post" class="" style="display:inline">
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
                                        <h1 class="text-center">No categories found</h1>
                                    </td>
                                </tr>
                            @endforelse
                            <tr>
                                <td colspan="3">
                                    {{ $categories->onEachSide(1)->links() }}
                                </td>
                            </tr>
                            
                        </tbody>
                        </table>
                </div>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

<!-- Form -->
<div class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel">Add category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <form class="custom-validation" action=" {{ route('categories.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-12">
                            <label class="form-label">Name</label>
                            <input name="name" type="text" class="form-control form-control-lg" required placeholder="Enter category name"/>
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