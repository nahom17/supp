@extends('layouts.app')
@section('content')
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="row">
                <div class="col-md-4">
                    <h1>{{ __('Gebruikers') }}</h1>
                </div>
                <div class="col-md-4">
                    <form class="d-flex" role="search" method="GET" action="{{ route('admin.users.search') }}">
                        <input class="form-control me-2" type="search" placeholder="Zoeken" aria-label="Search" name="search">
                        <button class="btn btn-dark" type="submit">Zoeken</button>
                    </form>
                </div>
                <div class="col-md-4 text-end">
                    <a href="" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#users">Gebruiker aanmaken</a>
                </div>

                <div class="modal fade" id="users" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Gebruiker aanmaken</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <form method="POST" action="{{ route('admin.users.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col">
                                        <label for="name" class="col-md-4 col-form-label">{{ __('Gebruikersnaam') }}</label>
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">

                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="email" class="col-md-4 col-form-label">{{ __('Email adres') }}</label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">

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
                                    <div class="col text-end">
                                        <button type="submit" class="btn btn-dark">Opslaan</button>
                                    </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Gebruikersnaam</th>
                                <th>E-mail adres</th>
                                <th>Rol</th>
                                <th>Bekijken</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role->name}}</td>
                                <td><a href="{{ route('admin.users.show', $user) }}" class="text-decoration-none">Bekijken</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>

            </div>
            <div class="card align-items-center border border-0 mt-3" style="background-color: #f8fafc;">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>
@endsection