<div class="modal fade" id="post" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Wat wil je posten?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-start">
                <form action="{{ route('posts.storePost') }}" method="post">
                    @csrf
                    <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
                    <div class="col mb-3">
                        <label for="content" class="col-md-4 col-form-label">{{ __('Wat wil je posten?') }}</label>
                        <textarea id="content" type="text" class="form-control @error('content') is-invalid @enderror" name=" content" autofocus></textarea>
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
                    <div class="col mb-3">
                        <label for="privacy_id">Privacy <br> <small>Wie kan je berichten zien?</small></label>
                        <select name="privacy_id" id="privacy_id" class="form-select">
                            @php
                                $privacies = App\Models\Privacy::all();
                            @endphp
                                @foreach($privacies as $privacy)
                                <option value="{{ $privacy->id }}">{{ $privacy->privacy_name }}</option>
                                @endforeach
                        </select>
                    </div>
                    <div class="col text-end">
                        <button class="btn btn-dark">Verstuur</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

</div>