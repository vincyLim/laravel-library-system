@extends('layout.admin')

@section("content")
    <div class="container text-center mt-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h1 class="display-4">Welcome, {{ Auth::user()->name }}!</h1>
                <p class="lead text-muted">Your role: <strong>{{ Auth::user()->role->name }}</strong></p>
                <p class="text-secondary">We are glad to have you here.</p>
                
            </div>
        </div>
    </div>
@endsection

