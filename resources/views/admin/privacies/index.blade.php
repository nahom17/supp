@extends('layouts.app')

@section('content')

<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-4">
                    <h1>{{ __('Privacy') }}</h1>
                </div>
                <div class="col-md-4">
                    <form class="d-flex" role="search" method="GET" action="{{ route('admin.privacies.search') }}">
                        <input class="form-control me-2" type="search" placeholder="Zoeken" aria-label="Search" name="search">
                        <button class="btn btn-dark" type="submit">Zoeken</button>
                    </form>
                </div>
                <div class="col-md-4 text-end">
                    <a href="" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#category">Privacy aanmaken</a>
                </div>

                <div class="modal fade" id="category" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Privacy aanmaken
                                </h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="POST" action="{{ route('admin.privacies.store') }}">
                                @csrf
                                <div class="modal-body">

                                    <div class="col mb-3">
                                        <label for="privacy_name" class="form-label">Bedenk een naam</label>
                                        <input type="text" name="privacy_name" id="privacy_name" class="form-control @error('privacy_name') is-invalid @else @enderror">
                                        @error('privacy_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>




                                    <div class="col">
                                        <label for="description" class="form-label">Schrijf een beschrijving</label>
                                        <textarea name="description" id="description" class="form-control @error('description') is-invalid @else @enderror">{!!old('description')!!}</textarea>
                                        @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="modal-footer border border-0">

                                    <button type="submit" class="btn btn-dark">Opslaan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Naam</th>
                                <th></th>
                                <th>Bekijken</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($privacies as $privacy)
                            <tr>
                                <td>{{ $privacy->privacy_name }}</td>
                                <td></td>

                                <td><a href="{{ route('admin.privacies.edit', $privacy) }}" class="text-decoration-none">Bekijken</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>


                </div>

            </div>
            <div class="card align-items-center border border-0 mt-3" style="background-color: #f8fafc;">
                {{ $privacies->links() }}
            </div>
        </div>
    </div>
</div>
@endsection