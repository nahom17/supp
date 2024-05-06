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
    <link href="{{ asset('css/extra.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
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
                            <a class="nav-link text-dark custom-tab-nonactive" href="{{ route('profile.friends', [Auth::user()]) }}">Vrienden <span class="badge text-bg-secondary">{{ $totalRequests }}</span></a>
                            @else
                            <a class="nav-link text-dark custom-tab-nonactive" href="{{ route('profile.friends', [Auth::user()]) }}">Vrienden</a>
                            @endif
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark custom-tab-active" href="{{ route('profile.settings', [Auth::user()])}}">Instellingen</a>
                        </li>
                    </ul>
                    <h5 class="text-start">Account gegevens</h5>

                    <form method="POST" action="{{ route('profile.update', $user) }}" enctype="multipart/form-data" class="text-start">
                        @csrf
                        @method('PUT')
                        <div class="col">
                            <label for="name" class="col-md-4 col-form-label">{{ __('Gebruikersnaam') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ Auth::user()->name }}" required autocomplete="name">

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        @if(!Auth::user()->provider_name)
                        <div class="col">
                            <label for="email" class="col-md-4 col-form-label">{{ __('Email adres') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ Auth::user()->email }}" required autocomplete="email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        @endif
                        <div class="col">
                            <label for="password" class="col-md-4 col-form-label">{{ __('Wachtwoord') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label">{{ __('Herhaal wachtwoord') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                        </div>

                        <div class="col mb-3">
                            <label for="image" class="col-md-4 col-form-label">{{ __('Verander je foto') }}</label>
                            <input type="file" class="form-control" aria-label="file example" id="image" name="image">
                        </div>

                        <div class="col text-end">
                            <button type="submit" class="btn btn-dark">Opslaan</button>
                        </div>
                    </form>
                    <div class="col text-start mt-5">
                        <h5>Privacy voorkeuren</h5>
                        <div class="col mb-3">
                            <label for="privacy_id">Wie kan je berichten zien?</label>
                            <select name="privacy_id" id="privacy_id" class="form-select">
                            @php
                                $privacies = App\Models\Privacy::all();
                            @endphp
                                @foreach($privacies as $privacy)
                                <option value="{{ $privacy->id }}">{{ $privacy->privacy_name }}</option>
                                @endforeach
                        </select>
                        </div>
                    </div>
                    <div class="col text-start mt-5">
                        <h5>Dark mode</h5>
                        <button class="btn btn-sm btn-dark" onclick="myFunction()">Toggle dark mode</button>
                    </div>
                    <div class="col text-start mt-5">
                        <h5>Profiel verwijderen</h5>
                        <a href="" data-bs-toggle="modal" data-bs-target="#deleteAccount" class="text-decoration-none text-danger">Verwijderen</a>


                    </div>
                    <div class="modal fade" id="deleteAccount" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Zeker weten?</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-start">
                                    <form action="{{ route('profile.ProfileDestroy', $user->name)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <div class="col text-end">
                                            <button type="submit" class="btn btn-dark btn-sm">Verwijderen</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                @include('user/includes/menu/sideposts')
            </div>
        </div>
    </main>
    @include('user/includes/menu/footer')
    <script>
        function myFunction() {
            var element = document.body;

            if (localStorage.getItem("dark-mode") === null) {
                element.classList.toggle("dark-mode");
                localStorage.setItem("dark-mode", "yes");
            } else {
                element.classList.toggle("dark-mode");
                localStorage.removeItem("dark-mode");
            }

        }

        var element = document.body;

        if (localStorage.getItem("dark-mode")) {
            element.classList.add('dark-mode');
        }
    </script>
</body>

</html>