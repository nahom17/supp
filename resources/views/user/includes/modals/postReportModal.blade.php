<div class="modal fade" id="report{{ $post->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col text-start">Weet je zeker dat je de post wilt rapporteren?</div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body text-start">

                <div class="row mb-0">
                    <div class="col">

                        <a href="{{ route('profile.user', $post->user->name) }}" class="text-decoration-none"><img src="{{ strlen(explode('https', $post->user->image)[0]) == 0 && $post->user->provider_name != NULL ? $post->user->image : asset('uploads/profileImage/' . $post->user->image) }}" alt="avatar" width="32" height="32" class="rounded-circle me-2">{{ $post->user->name }}</a><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dot" viewBox="0 0 16 16">
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
                <form action="{{ route('posts.report', $post->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-dark">Rapporteren</button>
                </form>


            </div>

        </div>
    </div>
</div>