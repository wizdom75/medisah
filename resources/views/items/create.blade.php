@extends('layouts.app')

@section('title', 'Add new item')

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

            </div>
        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Add new item</h4>
                                        <p class="card-title-desc">Parsley is a javascript form validation
                                            library. It helps you provide your users with feedback on their form
                                            submission before sending it to your server.</p>
        
                                        <form class="custom-validation" action=" {{ route('items.store') }}">
                                            @csrf
                                            <div class="mb-3">
                                                <label class="form-label">Name</label>
                                                <input name="name" type="text" class="form-control" required placeholder="Type something"/>
                                            </div>
        
                                            <div class="mb-3">
                                                <label class="form-label">Category</label>
                                                <div>
                                                    <select name="category" type="text" id="category" class="form-control" required
                                                            placeholder="Password">
                                                            <option value="0">None</option>
                                                            <option value="1">Test category</option>
                                                    </select>
                                                </div>
                                            </div>
        
                                            <div class="mb-3">
                                                <label class="form-label">Description</label>
                                                <div>
                                                    <textarea name="description" type="description" class="form-control" required
                                                            parsley-type="text" rows="5"></textarea>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">GTIN</label>
                                                <div>
                                                    <input name="gtin" parsley-type="text" type="text" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">SKU</label>
                                                <div>
                                                    <input name="sku" data-parsley-type="text" type="text"
                                                            class="form-control" required
                                                            placeholder=""/>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Unit</label>
                                                <div>
                                                    <select name="unit" id="unit" class="form-control">
                                                        <option value="item"> Per Item</option>
                                                        <option value="litre">Per litre</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Price</label>
                                                <div>
                                                    <input data-parsley-type="alphanum" type="text"
                                                            class="form-control" required
                                                            placeholder="Enter alphanumeric value"/>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Unit cost</label>
                                                <div>
                                                <input data-parsley-type="alphanum" type="text"
                                                            class="form-control" required
                                                            placeholder="Enter alphanumeric value"/>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Stock</label>
                                                <div>
                                                <input data-parsley-type="alphanum" type="text"
                                                            class="form-control" required
                                                            placeholder="Enter alphanumeric value"/>
                                                </div>
                                            </div>
                                            <div class="mb-0">
                                                <div>
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                                        Submit
                                                    </button>
                                                    <button type="reset" class="btn btn-secondary waves-effect">
                                                        Cancel
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
        
                                    </div>
                                </div>
                            </div> <!-- end col -->
        
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body">
        
                                        <h4 class="card-title">Range validation</h4>
                                        <p class="card-title-desc">Parsley is a javascript form validation
                                            library. It helps you provide your users with feedback on their form
                                            submission before sending it to your server.</p>
        
                                        <form action="#" class="custom-validation">
        
                                            <div class="mb-3">
                                                <label class="form-label">Min Length</label>
                                                <div>
                                                    <input type="text" class="form-control" required
                                                            data-parsley-minlength="6" placeholder="Min 6 chars."/>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Max Length</label>
                                                <div>
                                                    <input type="text" class="form-control" required
                                                            data-parsley-maxlength="6" placeholder="Max 6 chars."/>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Range Length</label>
                                                <div>
                                                    <input type="text" class="form-control" required
                                                            data-parsley-length="[5,10]"
                                                            placeholder="Text between 5 - 10 chars length"/>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Min Value</label>
                                                <div>
                                                    <input type="text" class="form-control" required
                                                            data-parsley-min="6" placeholder="Min value is 6"/>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Max Value</label>
                                                <div>
                                                    <input type="text" class="form-control" required
                                                            data-parsley-max="6" placeholder="Max value is 6"/>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Range Value</label>
                                                <div>
                                                    <input class="form-control" required type="text" min="6"
                                                            max="100" placeholder="Number between 6 - 100"/>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Regular Exp</label>
                                                <div>
                                                    <input type="text" class="form-control" required
                                                            data-parsley-pattern="#[A-Fa-f0-9]{6}"
                                                            placeholder="Hex. Color"/>
                                                </div>
                                            </div>
        
                                            <div class="mb-0">
                                                <div>
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                                        Submit
                                                    </button>
                                                    <button type="reset" class="btn btn-secondary waves-effect">
                                                        Cancel
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
        
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div>
@endsection