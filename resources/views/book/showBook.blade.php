@extends('layout.admin')

@section("content")
<div class="container mt-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-dark text-white">
            <h3 class="mb-0">Book Details</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- Left side: Book Cover -->
                <div class="col-md-5 d-flex justify-content-center align-items-center">
                    <img
                        src="{{ asset('storage/' . $book->book_cover) }}"
                        alt="Book Cover"
                        class="img-fluid rounded shadow"
                        style="max-height: 450px; object-fit: cover;"
                    >
                </div>

                <div class="col-md-7">
                    <h3 class="mb-3"><strong>{{ $book->title }}</strong></h3>

                    <p><strong>ID:</strong> {{ $book->id }}</p>

                    <p><strong>Categories:</strong>
                        @foreach ($book->categories as $category)
                        <span class="badge border border-dark text-dark">{{ $category->name }}</span>
                        @endforeach
                    </p>

                    <p><strong>Authors:</strong>
                        @foreach ($book->authors as $author)
                        <span class="badge border border-dark text-dark">{{ $author->name }}</span>
                        @endforeach
                    </p>

                    <p><strong>Description:</strong></p>
                    <p class="text-justify">{{ $book->description }}</p>

                    <p><strong>Status:</strong>
                        <span class="badge
                            @if($book->status === 'available') bg-success
                            @elseif($book->status === 'borrowed') bg-warning
                            @elseif($book->status === 'overdue') bg-danger
                            @else bg-secondary @endif">
                            {{ ucfirst($book->status) }}
                        </span>
                    </p>
                    <div class="mt-4">
                        <a href="{{ route('book.index') }}" class="btn btn-outline-secondary">Back to List</a>
                        <a href="{{ route('book.edit', $book->id) }}" class="btn btn-primary">Edit Book</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
