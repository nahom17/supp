@extends('layouts.app')

@section('content')


<div class="container mt-3">
    <div class="row justify-content-center g-5">
        <div class="col-md-10">
            <div class="row">
                <div class="col">
                    <h1>{{$privacy->privacy_name}}</h1>
                </div>
                <div class="col">
                    <ul class="nav nav-tabs justify-content-center border-0 mt-3 mb-3">

                        <li class=" nav-item">
                            <a class="nav-link text-dark custom-tab-active disabled" href="{{ route('admin.privacies.edit', $privacy) }}">Bewerken</a>
                        </li>

                    </ul>
                </div>
                <div class="col text-end">
                    <div class="dropdown-center">
                        <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Opties
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteCategory">Verwijderen</a></li>
                        </ul>
                    </div>
                </div>


                <div class="modal fade" id="deleteCategory" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Weet je zeker dat je deze privacy wilt verwijderen?</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">

                                    <div class="col text-end">
                                        <form action="{{ route('admin.privacies.destroy',  $privacy) }}" method="POST" class="inline">
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

            </div>


            <div class="card">

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.privacies.update', $privacy) }}">
                        @csrf
                        @method('PUT')
                        <div class="col mb-3">
                            <label for="privacy_name" class="form-label">Bedenk een naam</label>
                            <input type="text" name="privacy_name" id="privacy_name" class="form-control" value="{{ $privacy->privacy_name }}">
                        </div>


                        <div class="col mb-3">
                            <label for="description" class="form-label">Schrijf een beschrijving</label>
                            <textarea type="text" name="description" id="description" class="form-control" value="{!! $privacy->description !!}">{!! $privacy->description !!}</textarea>
                        </div>

                        <div class="col text-end">
                            <a href="{{ route('admin.privacies.index', $privacy) }}" class="text-decoration-none me-2">Annuleren</a>
                            <button type="submit" class="btn btn-dark">Opslaan</button>
                        </div>
                    </form>


                </div>
            </div>

        </div>


    </div>
</div>




@endsection