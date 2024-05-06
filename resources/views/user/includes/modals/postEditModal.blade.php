<div class="modal fade" id="edit{{ $post->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Bewerk je post</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-start">
                <div class="row mb-0">
                    <div class="col">

                        <a href="{{ route('profile.profile', $post->user->name) }}" class="text-decoration-none"><img src="{{ strlen(explode('https', Auth::user()->image)[0]) == 0 && Auth::user()->provider_name != NULL ? Auth::user()->image : asset('uploads/profileImage/' . Auth::user()->image) }}" alt="avatar" width="32" height="32" class="rounded-circle me-2">{{ $post->user->name }}</a><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dot" viewBox="0 0 16 16">
                            <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z" />
                        </svg>{{ $post->created_at->diffForHumans() }}

                    </div>

                </div>

                <div class="card border-0">
                    <div class="card-body ps-0" style="transform: rotate(0);">

                        <form action="{{ route('posts.update', $post) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" value="{{$post->category->id}}" name="category_id" id="category_id">
                            <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
                            <textarea name="content" id="content" class="form-control">{!! $post->content !!}</textarea>
                            <div class="col text-end mt-2">
                                <button class="btn btn-dark btn-sm">Opslaan</button>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>