@extends('layouts.app')
@section('content')

<div class="container mt-3">
    <div class="row justify-content-center g-5">
        <div class="col-md-8">
            <div class="row">
                <div class="col text-start">
                    <div class="row">
                        <div class="col-md-2">
                            <img src="{{ asset('uploads/profileImage/' . $user->image) }}" alt="avatar" width="32" height="32" class="rounded-circle">
                        </div>

                        <div class="col-md-10 text-start">
                            <div class="col fw-bold">
                                {{$user->name}}
                            </div>
                            <div class="col">
                                {{ $user->email }}
                            </div>
                        </div>

                    </div>


                </div>
                <div class="col-md-4 text-center mb-2">
                    <form class="d-flex" role="search" method="GET" action="{{ route('admin.users.postSearch', $user) }}">
                        <input class="form-control" type="search" placeholder="Zoeken" aria-label="Search" name="search">
                        <button class="btn btn-dark" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                            </svg></button>
                    </form>
                </div>
                <div class="col text-end">
                    <div class="dropdown-center">
                        <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Opties
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editUser">Bewerken</a></li>
                            <li><a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteUser">Verwijderen</a></li>
                        </ul>
                    </div>
                </div>
            </div>


            <div class="modal fade" id="deleteUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Weet je zeker dat je deze gebruiker wilt verwijderen?</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">

                                <div class="col text-end">
                                    <form action="{{ route('admin.users.destroy',  $user) }}" method="POST" class="inline">
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
            <div class="modal fade" id="editUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Gebruiker bewerken</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body text-start">
                            <form method="POST" action="{{ route('admin.users.update', $user) }}">
                                @csrf
                                @method('PUT')
                                <div class="col">
                                    <label for="name" class="col-md-4 col-form-label">{{ __('Gebruikersnaam') }}</label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col">
                                    <label for="email" class="col-md-4 col-form-label">{{ __('Email adres') }}</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

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

                                <div class="col">
                                    <label for="role_id" class="form-label">Kies een rol uit</label>
                                    <select class="form-select" id="role_id" name="role_id">

                                        @foreach($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach

                                    </select>
                                </div>


                                <div class="col text-end">
                                    <button type="submit" class="btn btn-dark">Opslaan</button>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <ul class="nav nav-tabs justify-content-center border-0 mt-5 mb-3">
                <li class="nav-item">
                    <a class="nav-link text-dark" href="{{ route('admin.users.show', $user) }}">Posts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark " href="{{ route('admin.users.comments', $user) }}">Comments</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark custom-tab-active" href="{{ route('admin.users.friends', $user) }}">Vrienden</a>
                </li>
            </ul>

            <div class="col text-start text-muted fs-6">

                Aantal vrienden <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dot" viewBox="0 0 16 16">
                    <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z" />
                </svg> {{count($user->friends)}}




            </div>


            <div class="card">
                <div class="card-body">
                    <table class="table table-hover">
                        @if(!empty($user->friends))
                        <thead>
                            <tr>
                                <th>Gebruikersnaam</th>
                                <th>Vriend geworden</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user->friends as $friend)
                            <tr>
                                <td>{{$friend->friend->name}}</td>
                                <td>{{ $friend->created_at->diffForHumans() }}</td>

                            </tr>



                            @endforeach
                        </tbody>




                        @else

                        <div class="alert alert-warning text-center" role="alert">
                            Deze gebruiker heeft nog geen vrienden
                        </div>

                        @endif

                </div>
            </div>

        </div>
    </div>
</div>



@endsection