@extends('layouts.auth')

@section('content')

<div class="account-pages my-5 pt-sm-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card overflow-hidden">
                    <div class="card-body pt-0">
                        <h3 class="text-center mt-5 mb-4">
                            <a href="index.html" class="d-block auth-logo">
                                <img src="/assets/images/logo-dark.png" alt="" height="30" class="auth-logo-dark">
                            </a>
                        </h3>
                        <div class="p-3">
                            <h4 class="text-muted font-size-18 mb-3 text-center">Reset Password</h4>
                            <div class="alert alert-info" role="alert">
                                Enter your Email and instructions will be sent to you!
                            </div>
                            <form class="form-horizontal mt-4" method="POST" action="{{ route('password.email') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="email" >{{ __('E-Mail Address') }}</label>

                                
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3 row">
                                    <div class="col-12 text-end">
                                        <button type="submit" class="btn btn-primary w-md waves-effect waves-light">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="mt-5 text-center">
                    <p>Remember It ? <a href="{{ route('login') }}" class="text-primary"> Sign In Here </a> </p>
                    &copy; <script>document.write(new Date().getFullYear())</script> {{ env('APP_NAME') }} 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
