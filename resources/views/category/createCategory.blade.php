@extends('layout.admin')

@section("content")
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h4>Create Genre</h4>
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
            <form method="post" action="{{route('category.store')}}" enctype="multipart/form-data">
                @csrf
                <x-form-text-input label="Name" name="name" required="required"/>

                <div class="form-group mt-3">
                    <label for="icon">Icon</label>
                    <input type="file" name="icon" id="icon" class="form-control" required="required">
                </div>

                <div class="mt-4 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
