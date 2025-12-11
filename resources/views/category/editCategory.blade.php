@extends('layout.admin')

@section("content")
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h4>Edit Genre</h4>
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
            <form method="post" action="{{route('category.update', $category->id)}}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <x-form-text-input label="Name" name="name" value="{{$category->name}}" required="required"/>

                <div class="form-group container mt-2">
                    <label for="icon">Icon</label>
                    <input type="file" name="icon" id="icon" class="form-control">
                    @if ($category->icon)
                        <img src="{{ asset("storage/".$category->icon) }}" alt="Category Icon" class="img-thumbnail mt-2" width="100">
                    @endif
                </div>

                <div class="mt-4 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
