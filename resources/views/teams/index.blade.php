@extends('layouts.app')

@section('title', 'Team')

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
            <button type="button" class="btn btn-primary waves-effect waves-light btn-lg" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">+ team member</button>
            </div>
        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    @forelse($users as $user)
    <div class="col-xl-4 col-md-6">
        <div class="card directory-card">
            <div>
                <div class="directory-bg text-center">
                    <div class="directory-overlay">
                        <img class="rounded-circle avatar-lg img-thumbnail" src="assets/images/users/user-{{ $user->id }}.jpg" alt="Generic placeholder image">
                    </div>
                </div>

                <div class="directory-content text-center p-4">
                    <p class=" mt-4">{{ $user->job_title }}</p>
                    <h5 class="font-size-16">{{ $user->name }}</h5>

                    <p class="text-muted"><i class="far fa-envelope btn-lg"></i> {{ $user->email }}</p>
                    <p class="text-muted"><i class="fa fa-phone btn-lg"></i> {{ $user->phone }}</p>

                    <!-- <ul class="social-links list-inline mb-0 mt-4">
                        <li class="list-inline-item">
                            <a href="" class="btn-primary"><i class="mdi mdi-email-box"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="" class="btn-info"><i class="fab fa-twitter"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="" class="btn-danger"><i class="fa fa-phone"> </i></a>{{ $user->phone }}
                        </li>
                        <li class="list-inline-item">
                            <a href="" class="btn-info"><i class="fab fa-skype"></i></a>
                        </li>
                    </ul> -->
                </div>
            </div>
        </div>
    </div>
    @empty
        <tr>
            <td colspan="3">
                <h1 class="text-center">No team members found</h1>
            </td>
        </tr>
    <!-- end col -->
    @endforelse
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
                <form class="custom-validation" action=" {{ route('teams.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label"> Contact person </label>
                            <input name="name" type="text" class="form-control form-control-lg" required placeholder=""/>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Job title</label>
                            <select name="job_title" id="role" class="form-control form-control-lg">
                                <option value="Cashier">Cashier</option>
                                <option value="Manager">Manager</option>
                                <option value="Director">Director</option>
                                <option value="Accountant">Accountant</option>
                            </select>
                            <input name="role" type="hidden" class="form-control form-control-lg" value="User"/>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label"> Contact email </label>
                            <input name="email" type="text" class="form-control form-control-lg" required placeholder=""/>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Phone</label>
                            <input name="phone" type="text" class="form-control form-control-lg" required placeholder=""/>
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
