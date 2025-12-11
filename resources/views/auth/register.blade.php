@extends('layout.auth')

@section('content')

<div class="login-container d-flex align-items-center justify-content-center p-3">
    <div class="login-card">
        <div class="logo-container">
            <img src="{{ asset('images/logo.jpeg') }}" alt="Logo" style="width: 100px; height: auto;" class="mb-2">
            <h4 class="text-center mb-4 border-gray-300">Register</h4>
        </div>

        <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
            <div class="mb-4">
                {{--<label class="mb-2" for="email" >Email</label>--}}
                <x-text-input id="name"
                              class="form-control"
                              type="text"
                              name="name"
                              placeholder="Username"
                              required autocomplete="name"
                              :value="old('name')"
                />
                <x-input-error :messages="$errors->get('name')" class="mt-2 text-danger" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-text-input id="email"
                              class="form-control"
                              type="email"
                              name="email"
                              placeholder="Email"
                              required autocomplete="username"
                              :value="old('email')"
                />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-text-input id="password"
                              class="form-control"
                              type="password"
                              name="password"
                              placeholder="Password"
                              required autocomplete="new-password"
                />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-text-input id="password_confirmation"
                              class="form-control"
                              type="password"
                              name="password_confirmation"
                              placeholder="Confirm Password"
                              required autocomplete="new-password"
                />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-danger" />
            </div>

            <input type="hidden" name="role_id" value="1">

            <button type="submit" class="btn btn-login btn-primary mt-5">
                Register
            </button>

            <div class="text-center">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>
            </div>

    </form>
    </div>
</div>
