@extends('layout.auth')

@section('content')
<div class="login-container d-flex align-items-center justify-content-center p-4">
    <div class="login-card">
        <div class="logo-container">
            <img src="{{ asset('images/logo.jpeg') }}" alt="Logo" style="width: 130px; height: auto;" class="mb-2">
            <h4 class="text-center mb-4">Login</h4>
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                Invalid credentials. Please try again.
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-4">
                {{--<label class="mb-2" for="email" >Email</label>--}}
                <x-text-input id="email"
                              class="form-control"
                              type="email"
                              name="email"
                              placeholder="Email"
                              required autocomplete="username"
                              :value="old('email')"
                />
            </div>

            <div class="mb-4">
                <x-text-input id="password"
                              class="form-control"
                              type="password"
                              name="password"
                              placeholder="Password"
                              required autocomplete="current-password" />
            </div>

            <div class="remember-me-container mb-3">
                <div class="form-check">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                        <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>
            </div>

            <button type="submit" class="btn btn-login btn-primary">
                Login
            </button>

            <div class="text-center">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
            </div>

        </form>
    </div>
</div>

@endsection
