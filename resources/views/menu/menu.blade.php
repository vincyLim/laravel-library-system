@extends('layout.main')

@push('style')
    <style>
        .sidebar {
            min-height: 100vh;
        }

        @media (max-width: 991px) {
            .sidebar {
                min-height: auto;  /* Let the height adjust based on content on smaller screens */
                padding-top: 10px;  /* Optional: reduce top padding on smaller screens */
            }
        }

        .title {
            font-family: 'Kaushan Script', cursive;
            color: #69247C;
        }

        .category-item {
            padding-left: 10px;
        }
        .group-item {
            cursor: pointer;
            font-weight: bold;
            margin-bottom: 10px;
        }
    </style>
@endpush

@section('content')

    <div class="container-fluid" style="background: #FFF8DE;">

        <div data-aos="fade-in mt-5" class="row">

            <!-- Sidebar -->
            <div class="col-lg-2 sidebar mt-5">

                <!-- Category sidebar-->
                <div class="accordion d-none d-lg-block mt-5" id="menuAccordion" style=" min-width: 200px;">
                    <h2 class="mb-4 d-none d-lg-block text-center title">Category</h2>

                    <!-- Category -->
                    <div class="d-flex flex-column align-items-center mt-5"> <!-- Centered Container -->
                        <ul class="list-group w-100">
                            <li class="list-group-item {{is_null($selectedCategory) ? 'active':''}}" style="overflow: hidden; display: flex; align-items: center;">
                                <a href="{{route('menu')}}" class="text-decoration-none text-dark w-100">
                                    <div class="d-flex align-items-center gap-2">
                                        <i class="bi bi-book-fill" style="padding-right: 8px;"></i>
                                        <span style="display:inline-block; max-width: 100%; font-size:18;">All Books</span>
                                    </div>
                                </a>
                            </li>
                            @foreach ($categories as $category)
                                <li class="list-group-item {{$selectedCategory === $category->name ? 'active':''}}" style="overflow: hidden; display: flex; align-items: center;">
                                    <a href="{{ route('menu', ['category' => $category->name]) }}" class="text-decoration-none text-dark w-100">
                                        <div class="d-flex align-items-center gap-2">
                                            <img src="{{ asset('storage/'.$category->icon) }}" alt="category-icon" style="height: 20px; width: auto; padding-right: 8px;">
                                            <span style="display:inline-block; max-width: 100%; font-size:18;">{{ $category->name }}</span>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- Category collapse bar-->
                <div class="pt-5">
                    <div class="d-block d-lg-none btn btn-lg d-flex justify-content-center mt-5"  data-bs-toggle="collapse" data-bs-target="#categoryNav">
                        <h1 class="title dropdown-toggle">
                            Category
                        </h1>
                    </div>
                </div>

                <div class="d-lg-none">
                    <div class="collapse navbar-collapse" id="categoryNav">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item text-center">
                                <a href="{{route('menu')}}" class="text-decoration-none text-dark w-100">
                                    <h5 class="d-flex align-items-center justify-content-center">
                                        All Books
                                    </h5>
                                </a>
                            </li>
                            @foreach ($categories as $category)
                            <li class="nav-item text-center">
                                <a href="{{route('menu', ['category' => $category->name])}}" class="text-decoration-none text-dark w-100">
                                    <h5 class="d-flex align-items-center justify-content-center">
                                        {{$category->name}}
                                    </h5>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Product Grid -->
            <div class="col-lg-10 pt-4 px-5 mt-lg-5">
                <h1 class="mb-4 mt-lg-3"><strong>{{ $selectedCategory ? $selectedCategory : 'All Books' }}</strong></h1>
                <div class="row">
                    <!-- Product Cards -->
                    @forelse($books as $book)
                    <x-book-card
                        :book-id="$book->id"
                        :book-title="$book->title"
                        :book-author="$book->authors->pluck('name')->join(', ')"
                        :book-category="$book->categories->pluck('name')->join(', ')"
                        :book-description="$book->description"
                        :book-cover="asset('storage/'.$book->book_cover)"
                        :book-request-link="route('borrowRequest', $book->id)"
                        :book-status="$book->status"
                        class="menu"
                    />
                    @empty
                        <p>No books found in this category.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
