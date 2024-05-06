@extends('layouts.app')

@section('content')

<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="row">
                <div class="col"></div>
                <div class="col">
                    <ul class="nav nav-tabs justify-content-center border-0 mt-3 mb-3">
                        <li class="nav-item">
                            <a class="nav-link text-dark custom-tab-active disabled" aria-current="page" href="#">Overzicht</a>
                        </li>

                    </ul>
                </div>
                <div class="col text-end">
                    <div class="dropdown-center">
                        <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Opties
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#post">Verwijderen</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="post" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Weet je zeker dat je deze post wilt verwijderen?</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">

                                <div class="col text-end">
                                    <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Verwijderen</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="card mb-5">
                <div class="card-body">
                    <div class="row g-0">
                        <div class="col">
                            <div class="card-body">
                                <div class="row mb-0">
                                    <div class="col">
                                        <a href="{{ route('admin.users.show', $post->user) }}" class="text-decoration-none">{{ $post->user->name }}</a> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dot" viewBox="0 0 16 16">
                                            <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z" />
                                        </svg>{{ $post->created_at->diffForHumans() }}

                                    </div>
                                </div>
                                <div class="card border-0">
                                    <div class="card-body ps-0">
                                        {!! $post->content !!}
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
                                                @csrf <button type="submit" class="btn btn-sm btn-link text-decoration-none"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
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
                    </div>
                </div>
            </div>

            <h4>Comments</h4>
            @if(count($post->comments) > 0)
            <div class="row">
                @foreach($post->comments as $comment)
                <div class="col">
                    <div class="card mb-2">
                        <div class="card-body">
                            <div class="row mb-0">
                                <div class="col">
                                    <a href="{{ route('admin.users.show', $post->user) }}" class="text-decoration-none">{{ $comment->user->name }}</a> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dot" viewBox="0 0 16 16">
                                        <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z" />
                                    </svg>{{ $comment->created_at->diffForHumans() }}
                                </div>
                                <div class="col text-end">
                                    <div class="dropdown-center">
                                        <a href="#" data-bs-toggle="dropdown" aria-expanded="false" class="text-dark">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                                                <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z" />
                                            </svg>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#comment{{ $comment->id }}">Verwijderen</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card border-0">
                                <div class="card-body ps-0">
                                    {{ $comment->content}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="modal fade" id="comment{{ $comment->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Weet je zeker dat je deze comment wilt verwijderen?</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">

                                    <div class="col text-end">
                                        <form action="{{ route('admin.posts.delete', [$post, $comment->id]) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Verwijderen</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                @endforeach
            </div>




            @else

            <div class="alert alert-warning text-center" role="alert">
                Deze post heeft nog geen comments
            </div>

            @endif

        </div>
    </div>
</div>
@endsection