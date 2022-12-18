<div class="container-fluid py-3 bg-white border-radius shadow-sm">
    <div class="row">
      <div class="col-lg-3 offset-lg-9">
        <div class="">
          {{-- <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
            <span class="avatar">
                <img class="rounded" src="images/p5.png" alt="avatar" height="40" width="40">
                <span class="avatar-status-online"></span>
            </span>
          </a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="#">Profile</a>
            <a class="dropdown-item" href="#">Logout</a>
            
          </div> --}}

          <a class="nav-link dropdown-toggle dropdown-user-link d-flex" id="dropdown-user" href="#" data-toggle="dropdown">
            @php
                $user     = auth()->user();
                $username = $user? \Illuminate\Support\Str::title($user->username) : "Login";
                $avatar   = $user && $user->profile && $user->profile->avatar?  asset($user->profile->avatar): "../../../lms/app-assets/images/portrait/small/avatar-s-11.jpg";
                $role     = $user && $user->roles()->count() > 0 ? $user->roles[0]->name : "";
            @endphp
            <div class="user-nav d-flex d-none d-flex flex-column mr-2 align-items-end">
                <span class="user-name fw-bolder">{{$username}}</span>
                <span class="user-status">{{$role}}</span>
            </div>
            <span class="avatar">
                <img class="round border-radius" src="{{$avatar}}" alt="avatar" height="40" width="40">
                <span class="avatar-status-online"></span>
            </span>
        </a>
        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
            <a class="dropdown-item" href="{{route('profile.edit.account')}}">
                <i class="me-50" data-feather="user"></i>
                LMS
            </a>
            <div class="dropdown-divider"></div>
            
            <a class="dropdown-item" href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="me-50" data-feather="power"></i>
                Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
        </div>
      </div>
    </div>
  </div>

  {{-- <nav class="navbar navbar-expand-lg navbar-light bg-white border-radius shadow-sm">
  
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse float-right" id="navbarSupportedContent">
         <ul class="navbar-nav ">
      
        <li class="nav-item dropdown ">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
            <span class="avatar">
                <img class="rounded" src="images/p5.png" alt="avatar" height="40" width="40">
                <span class="avatar-status-online"></span>
            </span>
          </a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="#">Profile</a>
            <a class="dropdown-item" href="#">Logout</a>
            
          </div>
        </li>
       
      </ul>
    
    </div>
  </nav> --}}