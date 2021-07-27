@extends('layouts.app')

@section('title', 'Products')

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
            <button type="button" class="btn btn-primary waves-effect waves-light btn-lg" data-bs-toggle="modal" data-bs-target=".bs-create-modal-lg">+ product </button>
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
                                <th>Generic name</th>
                                <th>Proprietary name</th>
                                <th>GTIN</th>
                                <th>SKU</th>
                                <th>Edit</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($products as $product)
                                <tr data-id="1">
                                    <td data-field="id" style="width: 80px">{{ $product->id }}</td>
                                    <td data-field="name">{{ $product->name }}</td>
                                    <td data-field="secondary_name">{{ $product->secondary_name }}</td>
                                    <td data-field="gtin">{{ $product->gtin }}</td>
                                    <td data-field="sku">{{ $product->sku }}</td>
                                    <td style="width: 100px">
                                        <a class="btn btn-outline-secondary btn-sm edit" title="Edit"  data-bs-toggle="modal" data-bs-target=".bs-update-modal-lg-{{ $product->id }}">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <!-- Update form -->
                                        <div class="modal fade bs-update-modal-lg-{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title mt-0" id="myLargeModalLabel">Edit product</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="custom-validation" action=" {{ route('products.update', $product) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="row">
                                                                <div class="mb-3 col-md-6">
                                                                    <label class="form-label">Main name</label>
                                                                    <input name="name" type="text" class="form-control form-control-lg" required value="{{ $product->name }}"/>
                                                                </div>
                                                                <div class="mb-3 col-md-6">
                                                                    <label class="form-label">Secondary name</label>
                                                                    <input name="secondary_name" type="text" class="form-control form-control-lg"  value="{{ $product->secondary_name }}"/>
                                                                </div>
                                                                <div class="mb-3 col-md-4">
                                                                    <label class="form-label">Category</label>
                                                                    <div>
                                                                        <select name="category_id" type="text" id="category" class="form-control form-control-lg" required
                                                                                placeholder="Password">
                                                                                <option value="0">None</option>
                                                                                <option value="1">Test category</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3 col-md-4">
                                                                    <label class="form-label">GTIN</label>
                                                                    <div>
                                                                        <input name="gtin" parsley-type="text" type="text" class="form-control form-control-lg" value="{{ $product->gtin }}"/>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3 col-md-4">
                                                                    <label class="form-label">SKU</label>
                                                                    <div>
                                                                        <input name="sku" data-parsley-type="text" type="text"
                                                                                class="form-control form-control-lg" 
                                                                                value="{{ $product->sku }}"/>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                            <div class="mb-3">
                                                                <label class="form-label">Description</label>
                                                                <div>
                                                                    <textarea name="description" type="description" class="form-control form-control-lg" required
                                                                            parsley-type="text" rows="5">{{ $product->description  }}</textarea>
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
                                        <form action=" {{ route('products.destroy', $product->id) }}" method="post" class="" style="display:inline">
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
                                <td colspan="6">
                                    <h1>No products found</h1>
                                </td>
                            </tr>
                            @endforelse
                            <tr>
                                <td colspan="6">
                                    {{ $products->onEachSide(1)->links() }}
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
<div class="modal fade bs-create-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel">Add a product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <form class="custom-validation" action=" {{ route('products.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Main name</label>
                            <input name="name" type="text" class="form-control form-control-lg" required placeholder=""/>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Secondary name</label>
                            <input name="secondary_name" type="text" class="form-control form-control-lg"  placeholder=""/>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label class="form-label">Category</label>
                            <div>
                                <select name="category_id" type="text" id="category" class="form-control form-control-lg" required
                                        placeholder="Password">
                                        <option value="0">None</option>
                                        <option value="1">Test category</option>
                                </select>
                            </div>
                        </div>
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
                                        class="form-control form-control-lg" 
                                        placeholder=""/>
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