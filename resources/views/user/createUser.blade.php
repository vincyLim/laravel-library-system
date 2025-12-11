@extends('layout.admin')

@section("content")
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h4>Create Users</h4>
        </div>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="post" action="{{route('user.store')}}">
                @csrf
                <x-form-text-input label="Name" name="name" required="required"/>
                <x-form-text-input label="Email" name="email" required="required"/>
                <x-form-text-input label="Password" name="password" type="password" required="required"/>

                <x-form-select label="Role" name="role_id" required="required">
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </x-form-select>

                <div class="mt-4 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
