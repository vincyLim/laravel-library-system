
@extends('layout.index')

<style>
    .nav-link:hover {
        background-color: #343a40; /* Darker background on hover */
    }
</style>

<div class="d-flex flex-row">
    <!-- Wider fixed sidebar (180px) with background applied to the entire sidebar -->
    <div class="d-flex flex-column flex-shrink-0 bg-dark position-fixed" id="sidebar" style="width: 180px; height: 100vh; overflow-x: hidden;">
        <!-- The collapse div is inside the sidebar, but doesn't control the background -->
        <div class="collapse show collapse-horizontal w-100" id="navbarContent">
            <ul class="nav nav-pills flex-column mb-auto p-2">
                <li class="nav-item">
                    <a class="nav-link text-white d-flex align-items-center" href="{{ route('home') }}" style="transition: background-color 0.3s;">
                        <i class="fas fa-home me-2"></i> <!-- Font Awesome home icon -->
                        <h3 class="mb-0">Home</h3>
                    </a>
                </li>
                @can("viewAny", \App\Models\User::class)
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('user*') ? 'active' : 'text-white' }}" href="{{ route('user.index') }}">Users</a>
                </li>
                @endcan

                {{-- add permission to view all the nav --}}
                @can("viewAny", \App\Models\BorrowRecord::class)
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('borrowRecord*') ? 'active' : 'text-white' }}" href="{{ route('borrowRecord.requesting') }}">Borrow Records</a>
                </li>
                @endcan

                @can("viewAny", \App\Models\Book::class)
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('book*') ? 'active' : 'text-white' }}" href="{{ route('book.index') }}">Books</a>
                </li>
                @endcan

                @can("viewAny", \App\Models\Category::class)
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('category*') ? 'active' : 'text-white' }}" href="{{ route('category.index') }}">Categories</a>
                </li>
                @endcan

                @can("viewAny", \App\Models\Author::class)
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('author*') ? 'active' : 'text-white' }}" href="{{ route('author.index') }}">Authors</a>
                </li>
                @endcan

                @can("viewAny", \App\Models\Role::class)
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('permission*') ? 'active' : 'text-white' }}" href="{{ route('permission.index') }}">Permissions</a>
                </li>
                @endcan

                @can("viewAny", \App\Models\Role::class)
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('role*') ? 'active' : 'text-white' }}" href="{{ route('role.index') }}">Roles</a>
                </li>
                @endcan

                @can("viewAny", \App\Models\Penalty::class)
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('penalty*') ? 'active' : 'text-white' }}" href="{{ route('penalty.show', "unpaid") }}">Penalties</a>
                </li>
                @endcan
            </ul>
        </div>
    </div>

    <!-- Full-height toggle button -->
    <div class="position-fixed d-flex align-items-center" id="toggle-container" style="left: 180px; height: 100vh; z-index: 1030;">
        <button class="navbar-toggler h-100 border-start border-end border-light bg-light rounded-0" 
                style="width: 20px; opacity: 0.7;"
                type="button" 
                data-bs-toggle="collapse" 
                data-bs-target="#navbarContent"
                aria-controls="navbarContent"
                aria-expanded="true"
                aria-label="Toggle navigation">
            <span style="writing-mode: vertical-lr; transform: rotate(180deg);">≡</span>
        </button>
    </div>

    <!-- Main content area with adjusted margin and full width expansion -->
    <div class="content-wrapper w-100" style="margin-left: 200px; min-height: 100vh; transition: margin-left 0.2s;">
        @yield('content')
    </div>
</div>

@push('script')
<script>
    $(document).ready(function() {
        var $sidebar = $('#sidebar');
        var $contentWrapper = $('.content-wrapper');
        var $toggleContainer = $('#toggle-container');
        var isCollapsed = false;
        
        // Check for stored state
        if (localStorage.getItem('sidebarCollapsed') === 'true') {
            collapseMenu();
        }
        
        // Handle toggle clicks directly instead of relying on bootstrap events
        $('.navbar-toggler').click(function() {
            if (isCollapsed) {
                expandMenu();
            } else {
                collapseMenu();
            }
            
            // Store state
            localStorage.setItem('sidebarCollapsed', isCollapsed);
        });
        
        function collapseMenu() {
            $sidebar.animate({width: '0'}, 200);
            $toggleContainer.animate({left: '0'}, 200);
            $contentWrapper.animate({
                marginLeft: '20px'
            }, 200);
            isCollapsed = true;
        }
        
        function expandMenu() {
            $sidebar.animate({width: '180px'}, 200);
            $toggleContainer.animate({left: '180px'}, 200);
            $contentWrapper.animate({
                marginLeft: '200px'
            }, 200);
            isCollapsed = false;
        }
    });
</script>
@endpush