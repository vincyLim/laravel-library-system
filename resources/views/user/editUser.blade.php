@extends('layout.admin')

@section("content")
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h4>Edit Users</h4>
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
            <form method="post" action="{{route('user.update', $user->id)}}">
                @method('PUT')
                @csrf
                <x-form-text-input label="Name" name="name" value="{{$user->name}}" required="required"/>
                <x-form-text-input label="Email" name="email" value="{{$user->email}}" required="required"/>   
                <x-form-text-input label="Password" name="password" type="password" value="{{$user->password}}" required="required"/>

                @if (Auth::id() !== $user->id)
                <x-form-select label="Role" name="role_id" required="required"> 
                    @foreach ($roles as $role)
                        <option 
                            value="{{ $role->id }}"
                            {{ $role->id === $user->role_id ? 'selected' : '' }}
                        >{{ $role->name }}</option>
                    @endforeach
                </x-form-select>
                @endif
                
                <div class="mt-4 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection