<div class="col-md-2 border-start">
    <div class="position-fixed">
        @if(Auth::check() == true)
        <div class="col">
            <form class="d-flex" role="search" method="GET" action="{{ route('search') }}">
                <input class="form-control me-2" type="search" placeholder="Zoeken" aria-label="Search" name="search" value="{{ request()->search }}">
                <button class="btn btn-dark" type="submit">Zoeken</button>
            </form>
        </div>
        @endif

        <div class="col text-start mt-3">
            <h4>Laatste posts</h4>
        </div>
        @php
        $messages = App\Models\Post::latest()->take(5)->get();
        @endphp

        @foreach($messages->take(-4) as $message)
        @if($message->reported == 0)
        <div class="card mb-3 border-0 text-start sidepost">
            <div class="card-body ">
                <div class="row mb-0">
                    <div class="col" id="side-post">
                        @if(Auth::check() == true)

                        <a href="{{ route('categories.showPost', [$message->category->name, $message->id]) }}" class="stretched-link text-decoration-none">{{ $message->user->name }}</a><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dot" viewBox="0 0 16 16">
                            <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z" />
                        </svg>{{ $message->created_at->diffForHumans() }}

                        @else

                        <a href="{{ route('login') }}" class="stretched-link text-decoration-none">{{ $message->user->name }}</a><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dot" viewBox="0 0 16 16">
                            <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z" />
                        </svg>{{ $message->created_at->diffForHumans() }}
                        @endif




                    </div>

                </div>
            </div>
        </div>
        @else


        @endif


        @endforeach
        @if(Auth::check() == true)
        <a href="{{ route('posts.index') }}" class="text-decoration-none">Bekijk alle posts</a>
        @endif


    </div>


</div>