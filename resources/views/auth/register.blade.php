@extends('layouts.auth')

@section('content')

<div class="account-pages my-1 pt-sm-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card overflow-hidden">
                    <div class="card-body pt-0">
                        <h3 class="text-center mt-5 mb-4">
                            <a href="/" class="d-block auth-logo">
                                <img src="assets/images/logo-dark.png" alt="" height="30" class="auth-logo-dark">
                            </a>
                        </h3>
                        <div class="p-3">
                            <p class="text-muted text-center">Get your free {{ env('APP_NAME') }} account now.</p>
                            <form class="form-horizontal mt-4" method="POST" action="{{ route('register') }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="name">Name</label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="email">Email</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="password">Password</label>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="password-confirm">{{ __('Confirm Password') }}</label>

                                    
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>


                                <div class="mb-3 row mt-4">
                                    <div class="col-12 text-end">
                                        <button class="btn btn-primary w-md waves-effect waves-light btn-block" type="submit">Register</button>
                                    </div>
                                </div>

                                <div class="mb-0 row">
                                    <div class="col-12 mt-4">
                                        <p class="text-muted mb-0 font-size-14">By registering you agree to the Lexa <a href="#" class="text-primary">Terms of Use</a></p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="mt-5 text-center">
                    <p>Already have an account ? <a href="{{ route('login') }}" class="text-primary"> Login </a> </p>
                    &copy; <script>document.write(new Date().getFullYear())</script> {{ env('APP_NAME') }} 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
