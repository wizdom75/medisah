@extends('layouts.auth')

@section('content')

<div class="account-pages my-5 pt-sm-5">
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
                            <h4 class="text-muted font-size-18 mb-1 text-center">Welcome Back !</h4>
                            <p class="text-muted text-center">Sign in to continue to your dashboard.</p>
                            <form class="form-horizontal mt-4"  method="POST" action="{{ route('login') }}">
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
                                <div class="mb-3">
                                    <label for="password" >{{ __('Password') }}</label>

                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
   
                                </div>
                                <div class="mb-3 row mt-4">
                                    <div class="col-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-6 text-end">
                                        <button class="btn btn-primary w-md waves-effect waves-light btn-block" type="submit">Log In</button>
                                    </div>
                                </div>
                                <div class="form-group mb-0 row">
                                    <div class="col-12 mt-4">
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="mt-5 text-center">
                    &copy; <script>document.write(new Date().getFullYear())</script> {{ env('APP_NAME') }} 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
