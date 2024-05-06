@if(Auth::check() == true)
<div class="col-md-2 border-end">
    <div class="position-fixed" id="side-menu">
        <div class="card border-0">
            <div class="list-group list-group-flush" style="background-color: #f8fafc;" id="side-menu">
                <a href="{{ route('categories.index') }}" class="list-group-item list-group-item-action fs-5 mt-4 sidemenubutton" id="side-menu" style="background-color: #f8fafc; border-bottom: 0px;">Categorieën</a>

                @if(!empty($totalRequests))
                <a class="list-group-item list-group-item-action  fs-5 mt-4 sidemenubutton" href="{{ route('profile.friends', [Auth::user()]) }}" id="side-menu" style="background-color: #f8fafc; border-bottom: 0px;">Vrienden <span class="badge badge-sm text-bg-secondary">{{ $totalRequests }}</span></a>
                @else
                <a class="list-group-item list-group-item-action fs-5 mt-4 sidemenubutton" href="{{ route('profile.friends', [Auth::user()]) }}" id="side-menu" style="background-color: #f8fafc; border-bottom: 0px;">Vrienden <span class="badge text-bg-secondary"></span></a>
                @endif
                <a href="{{ route('profile.profile', [Auth::user()])}}" class="list-group-item list-group-item-action fs-5 mt-4 sidemenubutton" id="side-menu" style="background-color: #f8fafc; border-bottom: 0px;">Profiel</a>
                <a href="{{ route('profile.settings', [Auth::user()])}}" class="list-group-item list-group-item-action fs-5 mt-4 sidemenubutton" id="side-menu" style="background-color: #f8fafc; border-bottom: 0px; ">Instellingen</a>
                <a href="" class="list-group-item list-group-item-action border-0 fs-5 mt-4" style="background-color: #f8fafc;" data-bs-toggle="modal" id="side-menu" data-bs-target="#post"><button class="btn btn-dark">Schrijf een post</button></a>

            </div>
        </div>
        <!-- <div class="chip">
            <img src="img_avatar.png" alt="Person" width="96" height="96">
            John Doe
        </div> -->
    </div>



    @include('user/includes/modals/postModal')

    @else
    <div class="col-md-2">
        <div class="position-fixed">
            <div class="card border-0">
                <div class="list-group list-group-flush" style="background-color: #f8fafc;">


                    <a href="{{ route('login') }}" class="list-group-item list-group-item-action border-0 fs-5 mt-4" style="background-color: #f8fafc;"><button class="btn btn-dark rounded-pill">Schrijf een post</button></a>

                </div>
            </div>
        </div>
    </div>

    @endif