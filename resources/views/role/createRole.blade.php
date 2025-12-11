<!-- @extends('layout.admin') -->

@section("content")
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h4>Create Role</h4>
        </div>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="post" action="{{route('role.store')}}">
                @csrf
                <x-form-text-input label="Role" name="name" required="required"/>
                <x-form-select label="Permissions" name="permissions[]" selectClass="formSelfMultiSelect">
                    @foreach ($permissions as $permission)
                        <option value="{{ $permission->name }}">{{ $permission->name }}</option>
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