
@extends('layout.main')
@section('content')

        <!-- Parallax Background Section -->
        <div class="rellax w-100" data-rellax-speed="-7" style="height: 70vh;" >
            <img data-aos="fade-in" class="h-100 w-100" src="{{ asset('images/background.jpg') }}" alt="Parallax Image" style="object-fit: cover; z-index: -1;">
        </div>

        <!-- Content Section with New Products -->
        <div data-aos="fade-up" style="background: #FFF8DE; position: relative; z-index: 1;">
            <div class="m-auto" style="width: 80%">

                <!-- New Books Section -->
                <br>
                <h1 class="p-3 m-0" ><strong>New Books</strong></h1>
                {{--Add view all--}}

                <div class="book-grid">
                    @forelse($newBooks as $book)
                        <x-book-card
                            :book-id="$book->id"
                            :book-title="$book->title"
                            :book-author="$book->authors->pluck('name')->join(', ')"
                            :book-category="$book->categories->pluck('name')->join(', ')"
                            :book-description="$book->description"
                            :book-cover="asset('storage/'.$book->book_cover)"
                            :book-request-link="route('borrowRequest', $book->id)"
                            :book-status="$book->status"
                        />
                    @empty
                        <p>No new books available.</p>
                    @endforelse
                </div>
                <br><hr>
                <!-- Categories section -->
                @foreach($categories as $category)
                    <h1 class="p-3 m-0" >
                        <a href="{{route('menu', ['category' => $category->name])}}" class="text-decoration-underline text-dark">
                            <strong>{{$category->name}}</strong>
                        </a>
                    </h1>
                    <div class="book-grid" style="min-height: 300px;">
                        @forelse($category->books as $book)
                            <x-book-card
                                :book-id="$book->id"
                                :book-title="$book->title"
                                :book-author="$book->authors->pluck('name')->join(', ')"
                                :book-category="$book->categories->pluck('name')->join(', ')"
                                :book-description="$book->description"
                                :book-cover="asset('storage/'.$book->book_cover)"
                                :book-request-link="route('borrowRequest', $book->id)"
                                :book-status="$book->status"
                            />
                        @empty
                        <div style="height:20em">
                            <h3 class="text-center text-secondary">No books in this category</h3>
                        </div>
                        @endforelse
                    </div>
                    <br><hr>
                @endforeach
            </div>
        </div>


@endsection

{{-- @section('modal')
    @include('modal.productDetails')
@endsection --}}
