@extends('layouts.app')

@section('title', 'My profile')

@section('content')

<div class="row">
    <div class="col-sm-6">
        <div class="page-title-box">
            <h4> @yield('title') </h4>
            @include('partials.breadcrumb')
        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card ">
            <div>
                <div class="text-center">
                    <div>
                        <input type="file" name="avatarUpload" id="avatarUpload" style="display: none" onchange="uploadAvatar()">
                        <label for="avatarUpload">
                            <img class="rounded-circle m-5" src="{{ getAvatar($user->id) }}" alt="Generic placeholder image" width="170" height="170">       
                        </label>                       
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8 card">
        <div class="mt-5 mt-lg-4 ">
            <form action="{{ route('profile.update', $user) }}" method="POST">
            @csrf
            @method('PATCH')
                <div class="row mb-4">
                    <label for="horizontal-firstname-input" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="horizontal-firstname-input" name="name"  value="{{ $user->name }}">
                    </div>
                    <label for="horizontal-email-input" class="col-sm-2 col-form-label">Job title</label>
                    <div class="col-sm-4">
                        <input type="email" class="form-control" id="horizontal-email-input" name="jobtitle" disabled value="{{ $user->job_title }}">
                    </div>
                    
                </div>
                <div class="row mb-4">
                    <label for="horizontal-email-input" class="col-sm-2 col-form-label">Phone</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="horizontal-email-input" name="phone"  value="{{ $user->phone }}">
                    </div>
                    <label for="horizontal-email-input" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-4">
                        <input type="email" class="form-control" id="horizontal-email-input" name="email" disabled  value="{{ $user->email }}">
                    </div>
                </div>

                <div class="row justify-content-end">
                    <div class="col-sm-12">
                        <div>
                            <button type="submit" class="btn btn-primary btn-block">Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div> <!-- end row -->
@endsection

@once
    <script>
        function uploadAvatar() {
            //console.log(window.event.target.files);
            const files = window.event.target.files
            const formData = new FormData()
            formData.append('avatar', files[0])

            fetch('/profile/upload-avatar', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                console.log(data)
            })
            .catch(error => {
                console.log(error)
            })
        }
    </script>
@endonce