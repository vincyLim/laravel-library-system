@extends('layout.auth')

@section('content')
<div class="login-container d-flex align-items-center justify-content-center p-4">
    <div class="login-card">
        <div class="logo-container">
            <img src="{{ asset('images/logo.jpeg') }}" alt="Logo" style="width: 130px; height: auto;" class="mb-2">
            <div class="mb-4 text-sm text-gray-600">
                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </div>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
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
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="btn btn-login btn-primary">
                    {{ __('Email Password Reset Link') }}
                </x-button>
            </div>
        </form>
    </div>
</div>

@endsection
