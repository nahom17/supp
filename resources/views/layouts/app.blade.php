<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="min-height: 100vh">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>

    <!-- Fonts -->

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <style>
        .ck-editor__editable_inline {
            min-height: 200px;
        }

        .sidemenubutton:hover {
            border-bottom: 1px solid black !important;
            /* border-top: 1px solid black !important;
            border-left: 1px solid black !important;
            border-right: 1px solid black !important; */
        }

        .custom-tab-nonactive:hover {
            border-bottom: 2px solid black !important;
            border-top: 1px solid black !important;
            border-left: 1px solid black !important;
            border-right: 1px solid black !important;
        }

        .custom-tab-active:hover {
            border-bottom: 2px solid black !important;
            border-top: 1px solid black !important;
            border-left: 1px solid black !important;
            border-right: 1px solid black !important;
        }

        .custom-tab-active {
            background: transparent !important;
            border-bottom: 2px solid black !important;
            /* border-radius: 0px !important; */
        }
    </style>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand border border-2 p-1 rounded-2" href="{{ route('welcome') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>
                    @if(Auth::check() == false )
                    <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                        @foreach($categories->take(-4) as $category)
                        <li>
                            <a href="{{ route('categories.CategoryShow', $category->name)}}" class="nav-link px-4 link-secondary">{{ $category->name }}</a>
                        </li>
                        @endforeach
                    </ul>
                    @elseif(Auth::user()->role_id == 1)
                    <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">

                        <li>
                            <a href="{{ route('admin.users.index') }}" class="nav-link px-4 link-secondary">Gebruikers</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.posts.index') }}" class="nav-link px-4 link-secondary">Posts</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.categories.index') }}" class="nav-link px-4 link-secondary">Categorieën</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.privacies.index') }}" class="nav-link px-4 link-secondary">Privacy</a>
                        </li>
                    </ul>
                    @else
                    <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                        @php
                        $categories = App\Models\Category::all();
                        @endphp
                        @foreach($categories->take(-4) as $category)
                        <li>
                            <a href="{{ route('categories.CategoryShow', $category->name)}}" class="nav-link px-4 link-secondary">{{ $category->name }}</a>
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
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <img src="{{ asset('uploads/profileImage/' . Auth::user()->image) }}" alt="avatar" width="32" height="32" class="rounded-circle">
                                {{ Auth::user()->name }}
                            </a>


                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                @if(Auth::user()->role_id == 1 )
                                <a href="{{ route('admin.users.index') }}" class="dropdown-item">Dashboard</a>
                                <a href="{{ route('profile.profile', Auth::user()->name) }}" class="dropdown-item">Mijn profiel</a>
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
        <main class="py-4">
            @yield('content')
        </main>


        <!-- <footer class="py-3 my-4 ">
            <ul class="nav justify-content-center border-bottom pb-3 mb-3">

            </ul>
            <p class="text-center text-muted">Nahom & Niels</p>
        </footer> -->
    </div>
    <script>
        ClassicEditor
            .create(document.querySelector('#content'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });


        $(document).ready(function() {
            $('.form-select').select2({
                theme: "classic"
            });
        });
    </script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script> -->
</body>

</html>