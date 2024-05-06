@extends('layouts.app')

@section('content')

<div class="container mt-3">
    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="row">
                <div class="col-md-4">
                    <h1>{{ __('Posts') }}</h1>
                </div>
                <div class="col-md-4">
                    <form class="d-flex" role="search" method="GET" action="{{ route('admin.posts.search') }}">
                        <input class="form-control me-2" type="search" placeholder="Zoeken" aria-label="Search" name="search">
                        <button class="btn btn-dark" type="submit">Zoeken</button>
                    </form>
                </div>
                <div class="col-md-4 text-end">
                    <a href="" class="btn btn-dark text-decoration-none" data-bs-toggle="modal" data-bs-target="#posts">Post aanmaken</a>
                </div>

                <div class="modal fade" id="posts" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Post aanmaken</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <form method="POST" action="{{ route('admin.posts.store') }}">
                                    @csrf

                                    <div class="col mb-3">
                                        <label for="content" class="col-md-4 col-form-label">{{ __('Content') }}</label>
                                        <textarea id="content" class="form-control @error('content') is-invalid @else @enderror" name="content" autofocus>{{ old('content')}}</textarea>
                                        @error('content')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="col mb-3">
                                        <label for="category_id" class="form-label">Kies een categorie uit</label>
                                        <select class="form-select" id="category_id" name="category_id">

                                            @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                    <div class="col text-end">
                                        <button type="submit" class="btn btn-dark">Opslaan</button>
                                    </div>

                            </div>




                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col">
                <ul class="nav nav-tabs justify-content-center border-0 mt-3 mb-3">
                    <li class="nav-item">
                        <a class="nav-link text-dark custom-tab-active" aria-current="page" href="#">Overzicht</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark custom-tab-nonactive" aria-current="page" href="{{ route('admin.posts.reported') }}">Gerapporteerde posts</a>
                    </li>

                </ul>

            </div>



            @foreach($posts as $post)
            <div class="row justify-content-center">

                <div class="col-md-12">

                    @if($post->reported == 0)
                    <div class="card mb-3 mt-2 text-start">
                        <div class="card-body">
                            <div class="row mb-0">
                                <div class="col">

                                    @if($post->user->id == Auth::user()->id)

                                    <a href="{{ route('profile.profile', $post->user->name) }}" class="text-decoration-none"><img src="{{ asset('uploads/profileImage/' . $post->user->image) }}" alt="avatar" width="32" height="32" class="rounded-circle me-2">{{ $post->user->name }}</a><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dot" viewBox="0 0 16 16">
                                        <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z" />
                                    </svg>{{ $post->created_at->diffForHumans() }}<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dot" viewBox="0 0 16 16">
                                        <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z" />
                                    </svg>{{$post->category->name}}
                                    @else
                                    <a href="{{ route('profile.user', $post->user->name) }}" class="text-decoration-none"><img src="{{ asset('uploads/profileImage/' . $post->user->image) }}" alt="avatar" width="32" height="32" class="rounded-circle me-2">{{ $post->user->name }}</a><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dot" viewBox="0 0 16 16">
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
                                            <li><a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#post{{ $post->id }}">Verwijderen</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="modal fade" id="post{{ $post->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <div class="col text-start">Weet je zeker dat je de post wilt verwijderen?</div>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body text-start">

                                                <div class="row mb-0">
                                                    <div class="col">

                                                        <a href="{{ route('profile.user', $post->user->name) }}" class="text-decoration-none"><img src="{{ asset('uploads/profileImage/' . $post->user->image) }}" alt="avatar" width="32" height="32" class="rounded-circle me-2">{{ $post->user->name }}</a><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dot" viewBox="0 0 16 16">
                                                            <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z" />
                                                        </svg>{{ $post->created_at->diffForHumans() }}

                                                    </div>

                                                </div>

                                                <div class="card border-0">
                                                    <div class="card-body ps-0" style="transform: rotate(0);">

                                                        {!! $post->content !!}
                                                    </div>

                                                </div>


                                            </div>
                                            <div class="modal-footer border border-0">
                                                <form action="{{ route('posts.destroy', $post) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-dark">Verwijderen</button>
                                                </form>


                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="card border-0">
                                <div class="card border-0">
                                    <div class="card-body ps-0" style="transform: rotate(0);">
                                        <a href="{{ route('admin.posts.show', $post) }}" class="stretched-link"></a>
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
                                            <button type="submit" class="btn btn-sm btn-link text-decoration-none"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
                                                </svg> {{ $post->likes }}</button>
                                        </form>
                                        @else
                                        @if($post->likes < 2) <form action="{{ route('posts.LikePostStore',$post->id)}}" method="POST">
                                            @csrf <button type="submit" class="btn btn-sm  btn-link text-decoration-none"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                                    <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                                                </svg> {{ $post->likes }}</button>
                                            </form>
                                            @else
                                            <form action="{{ route('posts.LikePostStore',$post->id)}}" method="POST">
                                                @csrf <button type="submit" class="btn btn-sm  btn-link"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
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


                    @else
                    <div class="card mb-3 mt-2 text-start border-danger">
                        <div class="card-body">
                            <div class="row mb-0">
                                <div class="col">

                                    @if($post->user->id == Auth::user()->id)

                                    <a href="{{ route('profile.profile', $post->user->name) }}" class="text-decoration-none"><img src="{{ asset('uploads/profileImage/' . $post->user->image) }}" alt="avatar" width="32" height="32" class="rounded-circle me-2">{{ $post->user->name }}</a><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dot" viewBox="0 0 16 16">
                                        <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z" />
                                    </svg>{{ $post->created_at->diffForHumans() }}<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dot" viewBox="0 0 16 16">
                                        <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z" />
                                    </svg>{{$post->category->name}}
                                    @else
                                    <a href="{{ route('profile.user', $post->user->name) }}" class="text-decoration-none"><img src="{{ asset('uploads/profileImage/' . $post->user->image) }}" alt="avatar" width="32" height="32" class="rounded-circle me-2">{{ $post->user->name }}</a><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dot" viewBox="0 0 16 16">
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
                                            <li><a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#post{{ $post->id }}">Verwijderen</a></li>
                                            <li><a href="" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#setFree{{ $post->id }}">Vrijgeven</a></li>
                                        </ul>
                                    </div>
                                </div>

                            </div>

                            <div class="card border-0">
                                <div class="card border-0">
                                    <div class="card-body ps-0" style="transform: rotate(0);">
                                        <a href="{{ route('admin.posts.show', $post) }}" class="stretched-link"></a>
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
                                            <button type="submit" class="btn btn-sm  btn-link text-decoration-none"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
                                                </svg> {{ $post->likes }}</button>
                                        </form>
                                        @else
                                        @if($post->likes < 2) <form action="{{ route('posts.LikePostStore',$post->id)}}" method="POST">
                                            @csrf <button type="submit" class="btn btn-sm  btn-link text-decoration-none"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                                    <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                                                </svg> {{ $post->likes }}</button>
                                            </form>
                                            @else
                                            <form action="{{ route('posts.LikePostStore',$post->id)}}" method="POST">
                                                @csrf <button type="submit" class="btn btn-sm  btn-link"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
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
                    <div class="modal fade" id="setFree{{ $post->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Zeker weten?</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <form method="POST" action="{{ route('admin.posts.setFree', $post->id) }}">
                                        @csrf
                                        @method('PUT')

                                        <div class="col text-end">
                                            <button type="submit" class="btn btn-dark">Opslaan</button>
                                        </div>

                                </div>




                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="post{{ $post->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <div class="col text-start">Weet je zeker dat je de post wilt verwijderen?</div>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body text-start">

                                    <div class="row mb-0">
                                        <div class="col">

                                            <a href="{{ route('profile.user', $post->user->name) }}" class="text-decoration-none"><img src="{{ asset('uploads/profileImage/' . $post->user->image) }}" alt="avatar" width="32" height="32" class="rounded-circle me-2">{{ $post->user->name }}</a><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dot" viewBox="0 0 16 16">
                                                <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z" />
                                            </svg>{{ $post->created_at->diffForHumans() }}

                                        </div>

                                    </div>

                                    <div class="card border-0">
                                        <div class="card-body ps-0" style="transform: rotate(0);">

                                            {!! $post->content !!}
                                        </div>

                                    </div>


                                </div>
                                <div class="modal-footer border border-0">
                                    <form action="{{ route('posts.destroy', $post) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-dark">Verwijderen</button>
                                    </form>


                                </div>

                            </div>
                        </div>
                    </div>



                    @endif
                </div>

            </div>




            @endforeach


            <div class="card align-items-center border border-0 mt-3" style="background-color: #f8fafc;">
                {{ $posts->links() }}
            </div>






        </div>


    </div>
</div>
@endsection