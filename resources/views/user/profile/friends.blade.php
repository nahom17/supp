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
            position: sticky bottom;
        }
    </style>
    @include('user/includes/menu/userheader')
    <main class="py-4">
        <div class="container mt-3">
            <div class="row justify-content-center text-center g-5">

                @include('user/includes/menu/sidemenu')


                <div class="col-md-6 m-5">
                    @if (session('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <img src="{{ strlen(explode('https', Auth::user()->image)[0]) == 0 && Auth::user()->provider_name != NULL ? Auth::user()->image : asset('uploads/profileImage/' . Auth::user()->image) }}" alt="avatar" width="160" height="160" class="rounded-circle">
                    <div class="col mt-4">
                        <h2>{{$user->name}}</h2>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="col" id="friends">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
                                    <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8Zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022ZM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816ZM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0Zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4Z" />
                                </svg> {{ $totalFriends }} vriend(en)
                            </div>
                            <div class="col" id="member-since">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar3" viewBox="0 0 16 16">
                                    <path d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857V3.857z" />
                                    <path d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                                </svg> Lid sinds: {{$user->created_at->diffForHumans()}}
                            </div>

                        </div>
                    </div>


                    <ul class="nav nav-tabs justify-content-center border-0 mt-3 mb-3">
                        <li class="nav-item">
                            <a class="nav-link text-dark custom-tab-nonactive" href="{{ route('profile.profile', [Auth::user()])}}">Mijn posts</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark custom-tab-nonactive" href="{{ route('profile.shared', [Auth::user()])}}">Gedeelde posts</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark custom-tab-nonactive" href="{{ route('profile.likes', [Auth::user()])}}">Vind-ik-leuks</a>
                        </li>
                        <li class="nav-item">
                            @if(!empty($totalRequests))
                            <a class="nav-link text-dark custom-tab-active" href="{{ route('profile.friends', [Auth::user()]) }}">Vrienden <span class="badge text-bg-secondary">{{ $totalRequests }}</span></a>
                            @else
                            <a class="nav-link text-dark custom-tab-active" href="{{ route('profile.friends', [Auth::user()]) }}">Vrienden</a>
                            @endif
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark custom-tab-nonactive" href="{{ route('profile.settings', [Auth::user()])}}">Instellingen</a>
                        </li>
                    </ul>
                    <ul class="nav nav-tabs justify-content-center border-0 mt-3 mb-3">
                        <li class="nav-item">
                            <a class="nav-link text-dark custom-tab-active" href="{{ route('profile.friends', [Auth::user()])}}">Vrienden <span class="badge text-bg-secondary"></span></a>
                        </li>
                        <li class="nav-item">
                            @if(!empty($totalRequests))
                            <a class="nav-link text-dark custom-tab-nonactive" href="{{ route('profile.requests', [Auth::user()])}}">Vriendschapsverzoeken <span class="badge text-bg-secondary">{{ $totalRequests }}</span></a>
                            @else
                            <a class="nav-link text-dark custom-tab-nonactive" href="{{ route('profile.requests', [Auth::user()])}}">Vriendschapsverzoeken <span class="badge text-bg-secondary"></span></a>
                            @endif
                        </li>

                    </ul>
                    <div class="col text-start text-muted fs-6">
                        Aantal vrienden <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dot" viewBox="0 0 16 16">
                            <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z" />
                        </svg> {{$totalFriends}}
                    </div>

                    @if($totalFriends > 0)
                    @foreach ($allFriends as $friend)
                    @if($friend->accepted == 1)


                    <div class="card mb-3 mt-4 border-0 text-start">
                        <div class="card-body">
                            <div class="row mb-0">
                                @if($friend->friend->id == Auth::user()->id)
                                <div class="col">
                                    <a href="{{ route('profile.user', $friend->user->name) }}" class="text-decoration-none"><img src="{{ asset('uploads/profileImage/' . $friend->user->image) }}" alt="avatar" width="32" height="32" class="rounded-circle me-2">{{ $friend->user->name }}</a>
                                </div>
                                @else
                                <div class="col">
                                    <a href="{{ route('profile.user', $friend->friend->name) }}" class="text-decoration-none"><img src="{{ asset('uploads/profileImage/' . $friend->friend->image) }}" alt="avatar" width="32" height="32" class="rounded-circle me-2">{{ $friend->friend->name }}</a>
                                </div>

                                @endif

                                <div class="col text-end">
                                    <a href="#" class="text-decoration-none text-danger" data-bs-toggle="modal" data-bs-target="#friend{{ $friend->friend->id }}">Vriend verwijderen</a>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="friend{{ $friend->friend->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5>Zeker weten?</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body text-end">
                                    <form action="{{route('profile.friends.destroy', $friend->id)}}" method="get">
                                        @csrf
                                        <button type="submit" class="btn btn-dark">Verwijderen</button>
                                    </form>

                                </div>


                            </div>
                        </div>
                    </div>

                    @endif
                    @endforeach

                    @else
                    <div class="alert alert-warning text-center" role="alert">
                        Je hebt nog geen vrienden
                    </div>

                    @endif


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