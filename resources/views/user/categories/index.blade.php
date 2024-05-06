<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

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
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="antialiased">
    <style>
        .ck-editor__editable_inline {
            min-height: 200px;
        }

        .kaart-category:hover {
            background-color: #0d6efd !important;
            box-shadow: 10px 10px 10px;
        }

        .sidepost:hover {
            transform: scale(1.03);
        }

        .post:hover {
            transform: scale(1.03);
        }

        .sidemenubutton:hover {
            border-bottom: 1px solid black !important;
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

        body {

            background-color: #f8fafc;
            color: black;
        }

        .dark-mode {

            background-color: #212529;
            color: white;
        }

        .dark-mode div {
            color: black;
        }

        .dark-mode .custom-tab-active {
            color: white !important;
            border-bottom: 2px solid white !important;
        }

        .dark-mode .custom-tab-nonactive {
            color: white !important;
        }

        .dark-mode .custom-tab-active:hover {
            border-bottom: 2px solid white !important;
            border-top: 1px solid white !important;
            border-left: 1px solid white !important;
            border-right: 1px solid white !important;
        }

        .dark-mode .custom-tab-nonactive:hover {
            border-bottom: 2px solid white !important;
            border-top: 1px solid white !important;
            border-left: 1px solid white !important;
            border-right: 1px solid white !important;
        }

        .dark-mode button {
            background-color: #FAF9F6;
            color: black;
        }

        .dark-mode .sidepost {
            background-color: #3f3f3f;
        }

        .dark-mode input {
            background-color: #3f3f3f;
            color: white;
        }

        .dark-mode #side-menu {
            background-color: #212529 !important;
            color: white;
        }

        .dark-mode #header {
            background-color: #3f3f3f !important;
            color: white;
        }

        .dark-mode .sidemenubutton:hover {
            border-bottom: 1px solid white !important;
        }

        .dark-mode .form-select {
            background-color: #3f3f3f;
            color: white;
        }

        .dark-mode h5,
        .dark-mode h4,
        .dark-mode h2,
        .dark-mode h1,
        .dark-mode h3,
        .dark-mode #friends,
        .dark-mode #member-since,
        .dark-mode label,
        .dark-mode #navbarDropdown,
        .dark-mode #footer-link,
        .dark-mode #header-link,
        .dark-mode #logo,
        .dark-mode #side-post,
        .dark-mode #typewriter,
        .dark-mode #subtitle {
            color: #FAF9F6 !important;
        }

        .dark-mode #jumbotron {
            background-color: #3f3f3f !important;
        }

        .dark-mode .kaart-category {
            background-color: #3f3f3f !important;
        }

        .dark-mode .kaart-category:hover {
            background-color: #0d6efd !important;
            box-shadow: 0px 0px 0px;
        }

        .dark-mode #footer {
            background-color: #3f3f3f !important;
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
        }
    </style>
    @include('user/includes/menu/userheader')
    <main class="py-4">
        <div class="container mt-3">
            <div class="row justify-content-center text-center">

                @include('user/includes/menu/sidemenu')


                <div class="col-md-6 me-5 ms-5">
                    <div class="row">
                        <div class="col text-start">
                            <h2>Alle categorieën</h2>
                        </div>
                        <div class="col">
                            <form class="d-flex" role="search" method="GET" action="{{ route('categories.search') }}">
                                <input class="form-control me-2" type="search" placeholder="Categorie zoeken" aria-label="Search" name="search">
                                <button class="btn btn-dark" type="submit">Zoeken</button>
                            </form>
                        </div>
                    </div>

                    <div class="row align-items-md-stretch mt-3">
                        @if(count($categories) > 0)
                        @foreach($categories as $category)
                        <div class="col-md-6 mb-3 ">
                            <div class="h-100 p-5 text-bg-dark rounded-3 kaart-category" style="transform: rotate(0);">
                                <a href="{{ route('categories.CategoryShow', $category->name)}}" class="stretched-link"></a>
                                <h1>{{$category->name}}</h1>

                                <!-- <button class="btn btn-outline-light"><a href="{{ route('categories.CategoryShow', $category->name)}}" class="text-decoration-none text-white">Bekijk {{$category->name}}</a></button> -->
                            </div>
                        </div>
                        @endforeach
                        @else
                        <div class="alert alert-warning text-center mt-5 mb-5" role="alert">
                            Geen categorie gevonden
                        </div>
                        @endif
                    </div>

                </div>
                @include('user/includes/menu/sideposts')
            </div>
        </div>
    </main>
    @include('user/includes/menu/footer')

    <script>
        var element = document.body;

        if (localStorage.getItem("dark-mode")) {
            element.classList.add('dark-mode');
        }
    </script>
</body>

</html>