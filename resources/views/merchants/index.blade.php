@extends('layouts.app')

@section('title', 'Merchants')

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
            <button type="button" class="btn btn-primary waves-effect waves-light btn-lg" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">+ merchant</button>
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
                                <th>Postcode</th>
                                <th>Contact person</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($merchants as $merchant)
                                <tr data-id="1">
                                    <td data-field="id" style="width: 80px">{{ $merchant->id }}</td>
                                    <td data-field="name">{{ $merchant->name }}</td>
                                    <td data-field="postcode">{{ $merchant->postcode }}</td>
                                    <td data-field="contact_person">{{ $merchant->owner[0]->name ?? '' }}<br>{{ $merchant->owner[0]->email ?? ''}}</td>
                                    <td style="width: 100px">
                                        <a class="btn btn-outline-secondary btn-sm edit" title="Edit"  data-bs-toggle="modal" data-bs-target=".bs-update-modal-lg-{{ $merchant->id }}">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <!-- Update modal -->
                                        <div class="modal fade bs-update-modal-lg-{{ $merchant->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg  modal-dialog-centered" >
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title mt-0" id="myLargeModalLabel">Update merchant</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="custom-validation" action=" {{ route('merchants.update', $merchant) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="row">
                                                                <div class="mb-3 col-md-6">
                                                                    <label class="form-label"> Contact person </label>
                                                                    <input name="name" type="text" class="form-control form-control-lg" required value="{{ $merchant->owner[0]->name }}"/>
                                                                </div>
                                                                <div class="mb-3 col-md-6">
                                                                    <label class="form-label">Designation / role</label>
                                                                    <select name="role" id="" class="form-control from-control-lg">
                                                                        <option value="Owner">Owner</option>

                                                                    </select>
                                                                    <input name="job_title" type="hidden" value="Director" />
                                                                </div>
                                                                <div class="mb-3 col-md-6">
                                                                    <label class="form-label"> Contact email </label>
                                                                    <input name="email" type="text" class="form-control form-control-lg" required value=" {{ $merchant->owner[0]->email }}"/>
                                                                </div>
                                                                <div class="mb-3 col-md-6">
                                                                    <label class="form-label">Phone</label>
                                                                    <input name="phone" type="text" class="form-control form-control-lg" required value="{{ $merchant->owner[0]->phone }}"/>
                                                                </div>
                                                                <div class="mb-3 col-md-6">
                                                                    <label class="form-label">Merchant name</label>
                                                                    <div>
                                                                        <input name="merchant_name" parsley-type="text" type="text" class="form-control form-control-lg" value="{{ $merchant->name }}" />
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3 col-md-6">
                                                                    <label class="form-label">Merchant domain</label>
                                                                    <div>
                                                                        <input name="merchant_domain" parsley-type="text" type="text" class="form-control form-control-lg" value="{{ $merchant->domain }}" />
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3 col-md-4">
                                                                    <label class="form-label">Address line 1</label>
                                                                    <div>
                                                                        <input name="address_line_1" data-parsley-type="text" type="text"
                                                                                class="form-control form-control-lg" required
                                                                                value="{{ $merchant->address_line_1 }}"/>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3 col-md-4">
                                                                    <label class="form-label">Address line 2</label>
                                                                    <div>
                                                                        <input name="address_line_2" data-parsley-type="text" type="text"
                                                                                class="form-control form-control-lg" 
                                                                                value="{{ $merchant->address_line_2 }}"/>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3 col-md-4">
                                                                    <label class="form-label">City / Town</label>
                                                                    <div>
                                                                        <input name="city" id="city" class="form-control form-control-lg" value="{{ $merchant->city }}">
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3 col-md-4">
                                                                    <label class="form-label">State / Province / County</label>
                                                                    <div>
                                                                        <input name="state" type="text"
                                                                                class="form-control form-control-lg"
                                                                                value="{{ $merchant->state }}"/>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3 col-md-4">
                                                                    <label class="form-label">Postcode / Zipcode</label>
                                                                    <div>
                                                                    <input name="postcode" type="text"
                                                                                class="form-control form-control-lg" 
                                                                                value="{{ $merchant->postcode }}"/>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3 col-md-4">
                                                                    <label class="form-label">Country</label>
                                                                    <div>
                                                                    <input name="country" type="text"
                                                                                class="form-control form-control-lg" required
                                                                                value="{{ $merchant->country }}"/>
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
                                        <form action=" {{ route('merchants.destroy', $merchant->id) }}" method="post" class="" style="display:inline">
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
                                        <h1 class="text-center">No merchants found</h1>
                                    </td>
                                </tr>
                            @endforelse
                            <tr>
                                <td colspan="5">
                                    {{ $merchants->onEachSide(1)->links() }}
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
    <div class="modal-dialog modal-lg  modal-dialog-centered" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel">Add a merchant</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <form class="custom-validation" action=" {{ route('merchants.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label"> Contact person </label>
                            <input name="name" type="text" class="form-control form-control-lg" required placeholder=""/>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Designation / role</label>
                            <select name="role" id="" class="form-control from-control-lg">
                                <option value="Owner">Owner</option>

                            </select>
                            <input name="job_title" type="hidden" value="Director" />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label"> Contact email </label>
                            <input name="email" type="text" class="form-control form-control-lg" required placeholder=""/>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Phone</label>
                            <input name="phone" type="text" class="form-control form-control-lg" required placeholder=""/>
                        </div>
                        <div class="mb-3 ">
                            <label class="form-label">Merchant name</label>
                            <div>
                                <input name="merchant_name" parsley-type="text" type="text" class="form-control form-control-lg" />
                            </div>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Merchant domain</label>
                            <div>
                                <input name="merchant_domain" parsley-type="text" type="text" class="form-control form-control-lg" />
                            </div>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label class="form-label">Address line 1</label>
                            <div>
                                <input name="address_line_1" data-parsley-type="text" type="text"
                                        class="form-control form-control-lg" required
                                        placeholder=""/>
                            </div>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label class="form-label">Address line 2</label>
                            <div>
                                <input name="address_line_2" data-parsley-type="text" type="text"
                                        class="form-control form-control-lg" 
                                        placeholder=""/>
                            </div>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label class="form-label">City / Town</label>
                            <div>
                                <input name="city" id="city" class="form-control form-control-lg">
                            </div>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label class="form-label">State / Province / County</label>
                            <div>
                                <input name="state" type="text"
                                        class="form-control form-control-lg"
                                        placeholder=""/>
                            </div>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label class="form-label">Postcode / Zipcode</label>
                            <div>
                            <input name="postcode" type="text"
                                        class="form-control form-control-lg" 
                                        placeholder=""/>
                            </div>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label class="form-label">Country</label>
                            <div>
                            <input name="country" type="text"
                                        class="form-control form-control-lg" required
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