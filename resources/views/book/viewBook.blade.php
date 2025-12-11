{{-- {{dd($books)}} --}}

@extends('layout.admin')

@section("content")
    <div class="container mt-5">

        <div class="card">
            <div class="card-header">
                <h4>Books</h4>
            </div>


            <div class="card-body">

                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Author</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($books as $book)
                        {{-- {{dd($book)}} --}}
                        <tr>
                            <td>{{ $book->id }}</td>
                            <td>{{ $book->title }}</td>
                            <td>
                                @foreach ($book->categories as $category)
                                {{ $category->name }}
                                @if (!$loop->last), @endif
                                @endforeach
                            </td>
                            <td>
                                @foreach ($book->authors as $author)
                                {{ $author->name }}
                                @if (!$loop->last), @endif
                                @endforeach
                            </td>
                            <td>{{ucfirst( $book->status )}}</td>
                            <td>
                                @can('delete', App\Models\Book::class)
                                <form action="{{ route('book.delete', $book->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                                @endcan

                                @can('view', App\Models\Book::class)
                                <a href="{{ route('book.show', $book->id) }}" class="btn btn-primary">View</a>
                                @endcan

                                @can('update', App\Models\Book::class)
                                <a href="{{ route('book.edit', $book->id) }}" class="btn btn-primary">Edit</a>
                                @endcan
                                
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>

                <div class="mt-3">
                    <a href="{{ route('book.create') }}" class="btn btn-success w-100">Create +</a>
                </div>
            </div>

            

        </div>
        

    </div>

@endsection

