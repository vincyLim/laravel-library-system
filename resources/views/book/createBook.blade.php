@extends('layout.admin')

@section("content")
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h4>Create Books</h4>
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
            <form method="post" action="{{route('book.store')}}" enctype="multipart/form-data">
                @csrf
                <x-form-text-input label="Title" name="title" required="required"/>
                <x-form-select label="Categories" name="category[]" selectClass="formMultiSelect" required="required">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </x-form-select>

                <x-form-select label="Author" name="author[]" selectClass="formSelfMultiSelect" required="required">
                    @foreach ($authors as $author)
                        <option value="{{ $author->name }}">{{ $author->name }}</option>
                    @endforeach
                </x-form-select>

                <x-form-text-area label="Description" name="description" required="required"/> 

                <x-form-text-input label="Book Cover" name="book_cover" type="file" required="required"/>

                <div class="mt-4 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
