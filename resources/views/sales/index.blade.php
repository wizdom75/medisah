@extends('layouts.app')

@section('title', 'Sales')

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
            <!-- <button type="button" class="btn btn-primary waves-effect waves-light btn-lg" data-bs-toggle="modal" data-bs-target=".bs-example-modal-md">+ sale</button> -->
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
                                <th>Value</th>
                                <th>Order date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse($sales as $sale)
                                @php
                                    $total = 0;
                                @endphp
                            <tr data-id="1">
                                <td data-field="id" style="width: 80px"> {{ $sale->id }}</td>
                                <td data-field="Items">
                                    <ul class="list-unstyled">
                                    @foreach(unserialize($sale->items) as $item)
                                    <!-- <li>{{ $item->name }} - ${{ number_format($item->price/100, 2) }} - {{ $item->gtin }}</li> -->
                                    @php
                                    $total += $item->price;
                                    @endphp
                                    @endforeach
                                    <li class="h6">Order value: ${{ number_format($total/100, 2) }}</li>
                                    </ul>
                                    
                                </td>
                                <td> {{ $sale->created_at }}</td>
                                <td style="width: 100px">
                                    <a class="btn btn-outline-secondary btn-sm edit" title="Edit">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>

                                    <form action=" {{ route('sales.destroy', $sale->id) }}" method="post" class="" style="display:inline">
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
                                    <h1 class="text-center">No sales found</h1>
                                </td>
                            </tr>
                            @endforelse
                            <tr>
                                <td colspan="3">
                                    {{ $sales->onEachSide(1)->links() }}
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
                <h5 class="modal-title mt-0" id="myLargeModalLabel">Add sale</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <form class="custom-validation" action=" {{ route('sales.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-12">
                            <label class="form-label">Name</label>
                            <input name="name" type="text" class="form-control form-control-lg" required placeholder="Enter sale name"/>
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