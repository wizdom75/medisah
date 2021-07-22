@extends('layouts.app')

@section('title', 'Items')

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
                <button type="button" class="btn btn-primary waves-effect waves-light btn-lg" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">+ Item</button>
                
            </div>
        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Table Edits</h4>
                <p class="card-title-desc">Table Edits is a lightweight jQuery plugin for making table rows editable.</p>

                <div class="table-responsive">
                    <table class="table table-editable table-nowrap align-middle table-edits">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>GTIN</th>
                                <th>Unit</th>
                                <th>Price</th>
                                <th>Cost</th>
                                <th>Stock</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($items as $item)
                            <tr data-id="1">
                                <td data-field="id" style="width: 80px"> {{ $item->id }}</td>
                                <td data-field="name">{{ $item->name }}</td>
                                <td data-field="name">{{ $item->gtin }}</td>
                                <td data-field="name">{{ $item->unit }}</td>
                                <td data-field="name">${{ number_format(($item->price/100), 2) }}</td>
                                <td data-field="name">${{ number_format(($item->cost/100), 2) }}</td>
                                <td data-field="name">{{ $item->stock }}</td>
                                <td style="width: 100px">
                                <a class="btn btn-outline-secondary btn-sm edit" title="Edit"  data-bs-toggle="modal" data-bs-target=".bs-update-modal-lg-{{ $item->id }}">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <!-- Form -->
                                <div class="modal fade bs-update-modal-lg-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title mt-0" id="myLargeModalLabel">Update item</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form class="custom-validation" action=" {{ route('items.update', $item) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="row">
                                                        <div class="mb-3 col-md-6">
                                                            <label class="form-label">Name</label>
                                                            <input name="name" type="text" class="form-control form-control-lg" required value="{{ $item->name }}"/>
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
                                                                    parsley-type="text" rows="5">{{ $item->description }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="mb-3 col-md-4">
                                                            <label class="form-label">GTIN</label>
                                                            <div>
                                                                <input name="gtin" parsley-type="text" type="text" class="form-control form-control-lg" value="{{ $item->gtin }}"/>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 col-md-4">
                                                            <label class="form-label">SKU</label>
                                                            <div>
                                                                <input name="sku" data-parsley-type="text" type="text"
                                                                        class="form-control form-control-lg" required
                                                                        value="{{ $item->sku }}"/>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 col-md-4">
                                                            <label class="form-label">Unit</label>
                                                            <div>
                                                                <select name="unit" id="unit" class="form-control form-control-lg">
                                                                    <option value="Item"> Per Item</option>
                                                                    <option value="Kilogram">Per Kilogram</option>
                                                                    <option value="Litre"> Per Litre</option>
                                                                    <option value="Metre">Per Metre</option>
                                                                    <option value="Pack"> Per Pack</option>
                                                                    <option value="Punnet">Per Punnet</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 col-md-4">
                                                            <label class="form-label">Price</label>
                                                            <div>
                                                                <input data-parsley-type="alphanum" type="text"
                                                                        class="form-control form-control-lg" name="price"
                                                                        value="{{ number_format($item->price/100, 2) }}"/>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 col-md-4">
                                                            <label class="form-label">Unit cost</label>
                                                            <div>
                                                            <input data-parsley-type="alphanum" type="text"
                                                                        class="form-control form-control-lg" name="cost"
                                                                        value="{{ number_format(($item->cost/100), 2) }}"/>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 col-md-4">
                                                            <label class="form-label">Stock</label>
                                                            <div>
                                                            <input data-parsley-type="alphanum" type="text"
                                                                        class="form-control form-control-lg" name="stock"
                                                                        value="{{ $item->stock }}"/>
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
                                <form action=" {{ route('items.destroy', $item->id) }}" method="post" class="" style="display:inline">
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
                                        <h1 class="text-center">No stock items found</h1>
                                    </td>
                                </tr>
                        @endforelse
                            <tr>
                                <td colspan="8">
                                    {{ $items->onEachSide(1)->links() }}
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
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel">Add item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <form class="custom-validation" action=" {{ route('items.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Name</label>
                            <input name="name" type="text" class="form-control form-control-lg" required placeholder=" "/>
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
                                    <option value="Item"> Per Item</option>
                                    <option value="Kilogram">Per Kilogram</option>
                                    <option value="Litre"> Per Litre</option>
                                    <option value="Metre">Per Metre</option>
                                    <option value="Pack"> Per Pack</option>
                                    <option value="Punnet">Per Punnet</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label class="form-label">Price</label>
                            <div>
                                <input data-parsley-type="alphanum" type="text"
                                        class="form-control form-control-lg" name="price"
                                        placeholder=""/>
                            </div>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label class="form-label">Unit cost</label>
                            <div>
                            <input data-parsley-type="alphanum" type="text"
                                        class="form-control form-control-lg" name="cost"
                                        placeholder=""/>
                            </div>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label class="form-label">Stock</label>
                            <div>
                            <input data-parsley-type="alphanum" type="text"
                                        class="form-control form-control-lg" name="stock"
                                        placeholder=""/>
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