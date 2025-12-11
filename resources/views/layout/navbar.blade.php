<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm position-fixed w-100 d-block" style="z-index: 1000; top: 0; left: 0; right: 0;">
    <div class="mx-5 d-flex justify-content-between align-items-center">

        <!-- Mobile Menu Button -->
        <div data-aos="zoom-in" class="d-block d-lg-none" style="width: 45%">
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <!-- Main Navigation -->
        <div data-aos="zoom-in" class="d-none d-lg-block" style="width: 45%">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item link-offset-5-hover">
                    <a class="nav-link link-opacity-100-hover" href="{{route('menu')}}"><h5>Menu</h5></a>
                </li>
            </ul>
        </div>

        <!-- Logo -->
        <div data-aos="zoom-in w-auto">
            <a class="navbar-brand mx-auto mx-lg-0 h-100" href="{{route('home')}}">
                <img src="{{ asset('images/logo.jpeg') }}" alt="Logo" height="50">
            </a>
        </div>

        <!-- Right Icons -->
        <div data-aos="zoom-in" class="d-flex align-items-center justify-content-end z-1" style="width: 45%">
            <!-- Search Form -->
            <form class="d-flex me-0 me-lg-3 d-none d-lg-block" action="{{route('search')}}" method="GET">
            <div class="input-group w-auto mt-2">
                <input class="form-control search-input" type="search" name="searchTerm"
                   placeholder="Search books..." aria-label="Search" required>
                <button class="btn btn-outline-secondary" type="submit">
                <i class="bi bi-search"></i>
                </button>
            </div>
            </form>

            <!-- User Account -->
            <div class="dropdown h-25">
            <button class="btn nav-icon dropdown-toggle " data-bs-toggle="dropdown">
                <i class="bi bi-person fs-4"></i> <!-- Same size for user account -->
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                @auth

                @can('accessManagement')
                <li class="dropdown-item">
                    <a class="dropdown-item" href="{{route("manage.home")}}">Management</a>
                </li>
                <li><hr class="dropdown-divider"></li>
                @endcan

                <!-- New option for borrow book -->
                {{-- @can('viewSelfHistory', Auth::user())  --}}
                <li class="dropdown-item">
                    <a class="dropdown-item" href="{{route("viewBorrowHistory")}}">Borrow History</a>
                </li>
                <li><hr class="dropdown-divider"></li>
                {{-- @endcan --}}

                {{--<li><a class="dropdown-item" href="#">My Profile</a></li>
                <li><a class="dropdown-item" href="#">My Orders</a></li>--}}
                <li class="dropdown-item">
                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <!-- Logout Button with Icon -->
                    <button class="btn text-decoration-none" onclick="event.preventDefault(); this.closest('form').submit();" style="font-size: 16px; display: flex; align-items: center;">
                        <i class="fas fa-sign-out-alt me-2"></i> <!-- Logout Icon -->
                        {{ __('Log Out') }}
                    </button>
                    </form>
                </li>
                
                @else
                <li><a class="dropdown-item" href="{{-- {{route('showLogin')}} --}}">Login</a></li>
                {{--<li><a class="dropdown-item" href="#">Register</a></li>--}}
                @endauth
            </ul>
            </div>
        </div>



    </div>
    

    {{--collapsed menu--}}
    <div data-aos="zoom-in" class="d-lg-none w-100">
        <!-- Search Form -->
        <form data-aos="zoom-in" class="d-flex d-lg-none mt-2 w-100" action="{{route('search')}}" method="GET">
            <div class="input-group w-100 z-0">
                <input class="form-control search-input z-n1" type="search" name="searchTerm"
                    placeholder="Search books..." aria-label="Search" required>
                <button class="btn btn-outline-secondary" type="submit">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </form>
        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
                <li class="nav-item">
                    <button class="nav-link link-opacity-100-hover w-100 btn btn-light " onclick="window.location.href='{{ route('menu') }}'">
                        Menu
                    </button>

                    {{--<a type="button" class="nav-link text-center" href="{{route('menu')}}">Menu</a>--}}
                </li>
            </ul>
        </div>
    </div>
</nav>

@section('style')
<style>
    /* Add some padding to body to prevent content from hiding under fixed navbar */
    body {
        padding-top: 70px;
    }

    .navbar {
        padding-top: 1rem;
        padding-bottom: 1rem;
    }

    .nav-icon {
        color: #333;
        text-decoration: none;
        padding: 0.5rem;
        border-radius: 50%;
        transition: background-color 0.2s;
    }

    .nav-icon:hover {
        background-color: #f8f9fa;
        color: #333;
    }

    .search-input {
        border-right: none;
        min-width: 250px;
    }

    .search-input:focus {
        box-shadow: none;
        border-color: #ced4da;
    }

    .nav-link {
        color: #333;
        font-weight: 500;
        padding-left: 1rem;
        padding-right: 1rem;
    }

    .nav-link:hover {
        color: #666;
    }

    @media (max-width: 991.98px) {
        .navbar-brand {
            margin-right: 0;
        }

        .search-input {
            min-width: auto;
        }
    }
</style>
@endsection

@push('script')
    <script>
       
    </script>

@endpush
