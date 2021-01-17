@extends('layouts.frontend.index')

@section('title')
    Login
@endsection

@section('content')
<div class="page-content page-auth">
    <div class="section-store-auth" data-aos="fade-up">
        <div class="container">
            <div class="row align-items-center row-login">
                <div class="col-lg-6 text-center">
                    <img 
                        src="/frontend/images/login-placeholder.png" 
                        class="w-50 mb-4 mb-lg-none"
                    />
                </div>
                <div class="col-lg-5">
                    <h2>
                        Belanja kebutuhan utama, <br>
                        menjadi lebih mudah
                    </h2>
                    <form action="{{ route('login') }}" method="POST" class="mt-3">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input name="email" type="text" id="email" class="form-control w-75 @error('email') is-invalid @enderror">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input name="password" type="password" id="password" required autocomplete="current-password" class="form-control w-75 @error('password') is-invalid @enderror">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                        <button class="btn btn-block btn-success w-75 mt-4" type="submit">
                            Sign In to My Account
                        </button>
                        <button class="btn btn-block btn-signup w-75 mt-2" type="submit">
                            Sign Up
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
