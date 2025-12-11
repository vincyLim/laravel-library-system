@extends('layout.main')

@section('content')

<div class="container-fluid" style="background: #FFF8DE;">
    <div class="pt-5 mt-5 container">
        <h1 class="mb-4 mt-3 mt-sm-5 pt-lg-0 pt-5 px-lg-5 px-0"><strong>Search Result: </strong></h1>
        <div class="row">

            @if ($results -> isempty())
                <div class="col-12 text-center">
                    <h2 class="text-danger">No results found</h2>
                </div>
            @else
            <!-- Product Cards -->
                @foreach($results as $book)
                    <x-book-card 
                        :book-id="$book->id"
                        :book-title="$book->title"
                        :book-author="$book->authors->pluck('name')->join(', ')"
                        :book-category="$book->categories->pluck('name')->join(', ')"  
                        :book-description="$book->description"
                        :book-cover="asset('storage/'.$book->book_cover)"
                        :book-request-link="route('borrowRequest', $book->id)"
                        :book-status="$book->status"
                        class="result"
                    />
                @endforeach
            @endif
            
        </div>
    </div>
</div>

@endsection