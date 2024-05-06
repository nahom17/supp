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
            /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
        }

        .post:hover {
            transform: scale(1.03);
            /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
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
    @include('user/includes/menu/userheader')
    <main class="py-4">
        <div class="container mt-3">
            <div class="row justify-content-center text-center">

                @include('user/includes/menu/sidemenu')

                <div class="col-md-6">
                    @if (session('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    <h2>Alle posts</h2>
                    <p>Dé plaats waar je alle nieuwe dingen van de wereld kan vinden</p>

                    @foreach($posts as $post)
                    @if($post->reported == 0)
                    @if($post->getTable() == 'shared_posts')
                    <div class="card border-0 post  text-start mb-3">
                        <div class="card-body">
                            <div class="row mb-0">
                                <div class="col">

                                    @if($post->user->id == Auth::user()->id)

                                    <a href="{{ route('profile.profile', $post->user->name) }}" class="text-decoration-none"><img src="{{ strlen(explode('https', Auth::user()->image)[0]) == 0 && Auth::user()->provider_name != NULL ? Auth::user()->image : asset('uploads/profileImage/' . Auth::user()->image) }}" alt="avatar" width="32" height="32" class="rounded-circle me-2">{{ $post->user->name }}</a> heeft gedeeld <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-repeat" viewBox="0 0 16 16">
                                        <path d="M11 5.466V4H5a4 4 0 0 0-3.584 5.777.5.5 0 1 1-.896.446A5 5 0 0 1 5 3h6V1.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384l-2.36 1.966a.25.25 0 0 1-.41-.192Zm3.81.086a.5.5 0 0 1 .67.225A5 5 0 0 1 11 13H5v1.466a.25.25 0 0 1-.41.192l-2.36-1.966a.25.25 0 0 1 0-.384l2.36-1.966a.25.25 0 0 1 .41.192V12h6a4 4 0 0 0 3.585-5.777.5.5 0 0 1 .225-.67Z" />
                                    </svg><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dot" viewBox="0 0 16 16">
                                        <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z" />
                                    </svg>{{ $post->created_at->diffForHumans() }}
                                    @else
                                    <a href="{{ route('profile.user', $post->user->name) }}" class="text-decoration-none"><img src="{{ strlen(explode('https', $post->user->image)[0]) == 0 && $post->user->provider_name != NULL ? $post->user->image : asset('uploads/profileImage/' . $post->user->image) }}" alt="avatar" width="32" height="32" class="rounded-circle me-2">{{ $post->user->name }}</a> heeft gedeeld <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-repeat" viewBox="0 0 16 16">
                                        <path d="M11 5.466V4H5a4 4 0 0 0-3.584 5.777.5.5 0 1 1-.896.446A5 5 0 0 1 5 3h6V1.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384l-2.36 1.966a.25.25 0 0 1-.41-.192Zm3.81.086a.5.5 0 0 1 .67.225A5 5 0 0 1 11 13H5v1.466a.25.25 0 0 1-.41.192l-2.36-1.966a.25.25 0 0 1 0-.384l2.36-1.966a.25.25 0 0 1 .41.192V12h6a4 4 0 0 0 3.585-5.777.5.5 0 0 1 .225-.67Z" />
                                    </svg><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dot" viewBox="0 0 16 16">
                                        <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z" />
                                    </svg>{{ $post->created_at->diffForHumans() }}
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
                                            @if($post->user->id == Auth::user()->id)
                                            <li>
                                                <form action="{{ route('posts.share', $post->id)}}" method="POST" class="dropdown-item text-start">
                                                    @csrf <button type="submit" class="btn btn-link text-decoration-none text-dark " onClick="this.form.submit(); this.disabled=true;">Delen verwijderen </button>
                                                </form>
                                            </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>

                            </div>

                            <div class="card mb-3 mt-4  text-start ">
                                <div class="card-body">
                                    <div class="row mb-0">
                                        <div class="col">

                                            @if($post->post->user->id == Auth::user()->id)

                                            <a href="{{ route('profile.profile', $post->post->user->name) }}" class="text-decoration-none"><img src="{{ strlen(explode('https', Auth::user()->image)[0]) == 0 && Auth::user()->provider_name != NULL ? Auth::user()->image : asset('uploads/profileImage/' . Auth::user()->image) }}" alt="avatar" width="32" height="32" class="rounded-circle me-2">{{ Auth::user()->name }}</a><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dot" viewBox="0 0 16 16">
                                                <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z" />
                                            </svg>{{ $post->post->created_at->diffForHumans() }}
                                            @else
                                            <a href="{{ route('profile.user', $post->post->user->name) }}" class="text-decoration-none"><img src="{{ strlen(explode('https', $post->post->user->image)[0]) == 0 && $post->post->user->provider_name != NULL ? $post->post->user->image : asset('uploads/profileImage/' . $post->post->user->image) }}" alt="avatar" width="32" height="32" class="rounded-circle me-2">{{ $post->post->user->name }}</a><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dot" viewBox="0 0 16 16">
                                                <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z" />
                                            </svg>{{ $post->post->created_at->diffForHumans() }}
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
                                                    <li><a href="{{ route('categories.showPost', [$post->post->category, $post->post]) }}" class="dropdown-item">Comments</a></li>
                                                    @if($post->user->id == Auth::user()->id)
                                                    <li><a href="" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit{{ $post->id }}">Bewerken</a></li>
                                                    <li><a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#post{{ $post->id }}">Verwijderen</a></li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="card border-0">
                                        <div class="card-body ps-0" style="transform: rotate(0);">
                                            <a href="{{ route('categories.showPost', [$post->post->category, $post->post]) }}" class="stretched-link"></a>
                                            {!! $post->post->content !!}
                                        </div>

                                    </div>

                                    <div class="row text-center">
                                        <div class="col">
                                            @if(count($post->post->comments) < 2) <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#comment{{ $post->post->id }}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat" viewBox="0 0 16 16">
                                                    <path d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z" />
                                                </svg> {{count($post->post->comments)}}</a>
                                                @else
                                                <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#comment{{ $post->post->id }}">{{count($post->post->comments)}} Comments</a>
                                                @endif
                                        </div>
                                        <div class="col">
                                            @php
                                            $like = App\Models\Like::where('user_id', Auth::user()->id)->where('post_id' , $post->post->id)->first();

                                            @endphp


                                            @if($like)
                                            <form action="{{ route('posts.dislikePost',[$post, $like])}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-link text-decoration-none" onClick="this.form.submit(); this.disabled=true;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
                                                    </svg> {{ $post->post->likes }}</button>
                                            </form>
                                            @else
                                            @if($post->post->likes < 2) <form action="{{ route('posts.LikePostStore',$post->post->id)}}" method="POST">
                                                @csrf <button type="submit" class="btn btn-sm btn-link text-decoration-none" onClick="this.form.submit(); this.disabled=true;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                                        <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                                                    </svg> {{ $post->post->likes }}</button>
                                                </form>
                                                @else
                                                <form action="{{ route('posts.LikePostStore',$post->post->id)}}" method="POST">
                                                    @csrf <button type="submit" class="btn btn-sm btn-link" onClick="this.form.submit(); this.disabled=true;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                                            <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                                                        </svg> {{ $post->post->likes }}</button>
                                                </form>
                                                @endif
                                                @endif
                                        </div>

                                        <div class="col">
                                            <form action="{{ route('posts.share', $post->post->id)}}" method="POST">
                                                @csrf <button type="submit" class="btn btn-sm btn-link text-decoration-none" onClick="this.form.submit(); this.disabled=true;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-repeat" viewBox="0 0 16 16">
                                                        <path d="M11 5.466V4H5a4 4 0 0 0-3.584 5.777.5.5 0 1 1-.896.446A5 5 0 0 1 5 3h6V1.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384l-2.36 1.966a.25.25 0 0 1-.41-.192Zm3.81.086a.5.5 0 0 1 .67.225A5 5 0 0 1 11 13H5v1.466a.25.25 0 0 1-.41.192l-2.36-1.966a.25.25 0 0 1 0-.384l2.36-1.966a.25.25 0 0 1 .41.192V12h6a4 4 0 0 0 3.585-5.777.5.5 0 0 1 .225-.67Z" />
                                                    </svg> {{ count($post->post->sharedPosts) }} </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else

                    <div class="card mb-3 mt-4 border-0 text-start post">
                        <div class="card-body">
                            <div class="row mb-0">
                                <div class="col">

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

                            </div>

                            <div class="card border-0">
                                <div class="card border-0">
                                    <div class="card-body ps-0" style="transform: rotate(0);">
                                        <a href="{{ route('categories.showPost', [$post->category, $post]) }}" class="stretched-link"></a>
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


                        </div>
                    </div>


                    @endif
                    @include('user/includes/modals/commentModal', ['post' => $post->getTable() == 'shared_posts' ? $post->post : $post])
                    @include('user/includes/modals/postDeleteModal', ['post' => $post->getTable() == 'shared_posts' ? $post->post : $post])
                    @include('user/includes/modals/postReportModal', ['post' => $post->getTable() == 'shared_posts' ? $post->post : $post])
                    @include('user/includes/modals/postEditModal', ['post' => $post->getTable() == 'shared_posts' ? $post->post : $post])
                    @else

                    @endif


                    @endforeach
                </div>



                @include('user/includes/menu/sideposts')
            </div>
        </div>
    </main>
    @include('user/includes/menu/footer')
</body>

</html>