@extends('layout.admin')

@section("content")
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h4>Edit Books</h4>
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
            <form method="post" action="{{route('book.update', $book->id)}}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <x-form-text-input label="Title" name="title" value="{{ $book->title }}" required="required"/>
                <x-form-select label="Category" name="category[]" selectClass="formMultiSelect" required="required">
                    @foreach ($categories as $category)
                    <option 
                        value="{{ $category->id }}" 
                        {{$book->categories->contains("id",$category->id) ? 'selected' : '' }}
                    >
                        {{ $category->name }}
                    </option>
                    @endforeach
                </x-form-select>

                <x-form-select label="Author" name="author[]" selectClass="formSelfMultiSelect" required="required">
                    @foreach ($authors as $author)
                    <option 
                        value="{{ $author->name }}" 
                        {{ $book->authors->contains("name",$author->name) ? 'selected' : '' }}
                    >
                        {{ $author->name }}
                    </option>
                    @endforeach
                </x-form-select>
                
                <x-form-text-area label="Description" name="description" required="required">{{ $book->description }}</x-form-text-area>

                <x-form-text-input label="Book Cover" name="book_cover" type="file" accept="image/*"/>

                <div class="container mt-3">

                    <img src="{{ asset('storage/' . $book->book_cover) }}" alt="Book Cover" class="mt-2" width="100">

                    {{-- <img src="{{ asset("storage/".$category->icon) }}" alt="Category Icon" class="img-thumbnail mt-2" width="100"> --}}
                </div>

                

                <div class="mt-4 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection