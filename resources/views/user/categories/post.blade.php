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


                <div class="col-md-6 m-5">
                    @if (session('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col text-start">
                            <a href="{{ url()->previous() }}">Terug</a>
                        </div>

                    </div>
                    <div class="card border-0 mb-3">
                        <div class="card-body text-start">
                            <div class="row mb-0">
                                <div class="col">
                                    @if(Auth::check() == true)

                                    @if($post->user->id == Auth::user()->id)

                                    <a href="{{ route('profile.profile', $post->user->name) }}" class="text-decoration-none"><img src="{{ strlen(explode('https', Auth::user()->image)[0]) == 0 && Auth::user()->provider_name != NULL ? Auth::user()->image : asset('uploads/profileImage/' . Auth::user()->image) }}" alt="avatar" width="32" height="32" class="rounded-circle me-2">{{ $post->user->name }}</a><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dot" viewBox="0 0 16 16">
                                        <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z" />
                                    </svg>{{ $post->created_at->diffForHumans() }}<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dot" viewBox="0 0 16 16">
                                        <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z" />
                                    </svg> {{$post->category->name}}
                                    @else
                                    <a href="{{ route('profile.user', $post->user->name) }}" class="text-decoration-none"><img src="{{ strlen(explode('https', $post->user->image)[0]) == 0 && $post->user->provider_name != NULL ? $post->user->image : asset('uploads/profileImage/' . $post->user->image) }}" alt="avatar" width="32" height="32" class="rounded-circle me-2">{{ $post->user->name }}</a><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dot" viewBox="0 0 16 16">
                                        <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z" />
                                    </svg>{{ $post->created_at->diffForHumans() }}<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dot" viewBox="0 0 16 16">
                                        <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z" />
                                    </svg> {{$post->category->name}}
                                    @endif
                                    @else
                                    <a href="{{ route('profile.user', $post->user->name) }}" class="text-decoration-none"><img src="{{ strlen(explode('https', $post->user->image)[0]) == 0 && $post->user->provider_name != NULL ? $post->user->image : asset('uploads/profileImage/' . $post->user->image) }}" alt="avatar" width="32" height="32" class="rounded-circle me-2">{{ $post->user->name }}</a><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dot" viewBox="0 0 16 16">
                                        <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z" />
                                    </svg>{{ $post->created_at->diffForHumans() }}<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dot" viewBox="0 0 16 16">
                                        <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z" />
                                    </svg> {{$post->category->name}}
                                    @endif

                                </div>
                                <div class="col-md-2 text-end">
                                    <div class="dropdown-center">
                                        <a href="#" data-bs-toggle="dropdown" aria-expanded="false" class="text-dark">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                                                <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z" />
                                            </svg>
                                        </a>
                                        <ul class="dropdown-menu">
                                            @if($post->user->id != Auth::user()->id)
                                            <li><a href="" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#report{{ $post->id }}">Rapporteren</a></li>
                                            @endif
                                            <li><a href="{{ route('categories.showPost', [$post->category, $post]) }}" class="dropdown-item">Comments</a></li>
                                            @if($post->user->id == Auth::user()->id)
                                            <li><a href="" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit{{ $post->id }}">Bewerken</a></li>
                                            <li><a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#post{{ $post->id }}">Verwijderen</a></li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                                @include('user/includes/modals/postDeleteModal')

                            </div>

                            <div class="card border-0">
                                
                                <div class="card-body ps-0">
                                    {!! $post->content !!}

                                </div>

                            </div>

                            <div class="row text-center">
                                <div class="col">
                                    @if(count($post->comments) < 2) <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#comment{{ $post->id }}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat" viewBox="0 0 16 16">
                                            <path d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z" />
                                        </svg> {{count($post->comments)}}</a>
                                        @else
                                        <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#comment{{ $post->id }}">{{count($post->comments)}} Comments</a>
                                        @endif
                                </div>
                                <div class="col">
                                    @php
                                    $like = App\Models\Like::where('user_id', Auth::user()->id)->where('post_id' , $post->id)->first();

                                    @endphp


                                    @if($like)
                                    <form action="{{ route('posts.dislikePost',[$post, $like])}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-link text-decoration-none" onClick="this.form.submit(); this.disabled=true;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
                                            </svg> {{ $post->likes }}</button>
                                    </form>
                                    @else
                                    @if($post->likes < 2) <form action="{{ route('posts.LikePostStore',$post->id)}}" method="POST">
                                        @csrf <button type="submit" class="btn btn-sm btn-link text-decoration-none" onClick="this.form.submit(); this.disabled=true;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                                <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                                            </svg> {{ $post->likes }}</button>
                                        </form>
                                        @else
                                        <form action="{{ route('posts.LikePostStore',$post->id)}}" method="POST">
                                            @csrf <button type="submit" class="btn btn-sm btn-link" onClick="this.form.submit(); this.disabled=true;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                                    <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                                                </svg> {{ $post->likes }}</button>
                                        </form>
                                        @endif
                                        @endif
                                </div>

                                <div class="col">
                                    <form action="{{ route('posts.share', $post->id)}}" method="POST">
                                        @csrf <button type="submit" class="btn btn-sm btn-link text-decoration-none" onClick="this.form.submit(); this.disabled=true;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-repeat" viewBox="0 0 16 16">
                                                <path d="M11 5.466V4H5a4 4 0 0 0-3.584 5.777.5.5 0 1 1-.896.446A5 5 0 0 1 5 3h6V1.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384l-2.36 1.966a.25.25 0 0 1-.41-.192Zm3.81.086a.5.5 0 0 1 .67.225A5 5 0 0 1 11 13H5v1.466a.25.25 0 0 1-.41.192l-2.36-1.966a.25.25 0 0 1 0-.384l2.36-1.966a.25.25 0 0 1 .41.192V12h6a4 4 0 0 0 3.585-5.777.5.5 0 0 1 .225-.67Z" />
                                            </svg> {{ count($post->sharedPosts) }} </button>
                                    </form>
                                </div>


                            </div>
                        </div>




                        @include('user/includes/modals/commentModal')
                        @include('user/includes/modals/postReportModal')
                        @include('user/includes/modals/postEditModal')
                    </div>
                    @if(Auth::check() == true)
                    <div class="card mb-3 border-0 text-start">
                        <div class="card-body">
                            <form method="POST" action="{{ route('posts.comments.store', $post) }}">
                                @csrf


                                <div class="col">
                                    <textarea name="content" id="content" class="form-control" placeholder="Wat is je comment?">{{old('description')}}</textarea>
                                    @error('content')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>



                                <div class="col text-end mt-3">
                                    <button type="submit" class="btn btn-dark">Opslaan</button>
                                </div>




                            </form>
                        </div>
                    </div>
                    @endif


                    @foreach($post->comments as $comment)

                    <div class="card border-0 mb-3 text-start">
                        <div class="card-body">
                            <div class="row mb-0">
                                <div class="col">
                                    @if(Auth::check() == true)
                                    @if($comment->user->id == Auth::user()->id)

                                    <a href="{{ route('profile.profile', $comment->user->name) }}" class="text-decoration-none"><img src="{{ strlen(explode('https', Auth::user()->image)[0]) == 0 && Auth::user()->provider_name != NULL ? Auth::user()->image : asset('uploads/profileImage/' . Auth::user()->image) }}" alt="avatar" width="32" height="32" class="rounded-circle me-2">{{ $comment->user->name }}</a><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dot" viewBox="0 0 16 16">
                                        <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z" />
                                    </svg>{{ $comment->created_at->diffForHumans() }}
                                    @else
                                    <a href="{{ route('profile.user', $comment->user->name) }}" class="text-decoration-none"><img src="{{ strlen(explode('https', $comment->user->image)[0]) == 0 && $comment->user->provider_name != NULL ? $comment->user->image : asset('uploads/profileImage/' . $comment->user->image) }}" alt="avatar" width="32" height="32" class="rounded-circle me-2">{{ $comment->user->name }}</a><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dot" viewBox="0 0 16 16">
                                        <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z" />
                                    </svg>{{ $comment->created_at->diffForHumans() }}
                                    @endif

                                    @else
                                    <a href="{{ route('profile.user', $comment->user->name) }}" class="text-decoration-none"><img src="{{ asset('uploads/profileImage/' . $comment->user->image) }}" alt="avatar" width="32" height="32" class="rounded-circle me-2">{{ $comment->user->name }}</a><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dot" viewBox="0 0 16 16">
                                        <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z" />
                                    </svg>{{ $comment->created_at->diffForHumans() }}
                                    @endif
                                </div>
                                @if($comment->user->id == Auth::user()->id)
                                <div class="col-md-2 text-end">
                                    <div class="dropdown-center">
                                        <a href="#" data-bs-toggle="dropdown" aria-expanded="false" class="text-dark">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                                                <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z" />
                                            </svg>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li> <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit{{ $comment->id }}">Bewerken</a></li>
                                            <li><a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete{{ $comment->id }}">Verwijderen</a></li>
                                        </ul>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class="card border-0">
                                <div class="card-body ps-0">
                                    {!! $comment->content !!}
                                </div>


                            </div>
                        </div>
                    </div>

                    @include('user/includes/modals/commentDeleteModal')
                    @include('user/includes/modals/commentEditModal')




                    @endforeach


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