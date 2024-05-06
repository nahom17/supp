<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" id="header">
    <div class="container">
        <a class="navbar-brand border border-2 p-1 rounded-2" href="{{ route('welcome') }}" id="logo">
            {{ config('app.name', 'MessageBoard') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">

            </ul>
            @if(count($categories) > 0)
            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                @foreach($categories->take(-4) as $cate)
                <li>
                    <a href="{{ route('categories.CategoryShow', $cate->name)}}" class="nav-link px-4 link-secondary" id="header-link">{{ $cate->name }}</a>
                </li>
                @endforeach
            </ul>

            @else
            @php
            $allCategories = App\Models\Category::all();

            @endphp
            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                @foreach($allCategories->take(-4) as $cate)
                <li>
                    <a href="{{ route('categories.CategoryShow', $cate->name)}}" class="nav-link px-4 link-secondary">{{ $cate->name }}</a>
                </li>
                @endforeach
            </ul>
            @endif

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                @if (Route::has('login'))
                <li class="nav-item">
                    <a class="nav-link" id="login" href="{{ route('login') }}">{{ __('Log in') }}</a>
                </li>
                @endif

                @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" id="register" href="{{ route('register') }}">{{ __('Registeren') }}</a>
                </li>
                @endif
                @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <img src="{{ strlen(explode('https', Auth::user()->image)[0]) == 0 && Auth::user()->provider_name != NULL ? Auth::user()->image : asset('uploads/profileImage/' . Auth::user()->image) }}" alt="avatar" width="32" height="32" class="rounded-circle">
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        @if(Auth::user()->role_id == 1)
                        <a href="{{ route('admin.users.index') }}" class="dropdown-item">Dashboard</a>
                        @endif
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>