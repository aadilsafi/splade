
<!-- END: Main Menu-->


{{-- <div class="bg-white sidebar-css border-radius shadow overflow-hidden">

    <div class="sidebar-header p-3">
        <div class="row">
            <div class="col-4">
                <img src="{{ asset('lms/app-assets') }}/images/logo/logo-u-white.png" alt="unilever-logo" class="img-fluid">
            </div>
            <div class="col-8">
                <h3 class="mb-0">Learning Platform</h3>
            </div>
        </div>
    </div>

    <div class="sidebar-content p-3">
        <ul class="nav flex-column mt-4">
            <li class="nav-item">
                <a class="nav-link active" href="/student-profile">
                    <i class="fa fa-user mr-3"></i>{{ __('lang.portalsidebar.my_profile') }}
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/trainee-calendar">
                    <i class="fa fa-calendar mr-3"></i>{{ __('lang.portalsidebar.my_training_calendar') }}
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/leaderboard">
                    <i class="fa fa-trophy mr-3"></i>{{ __('lang.portalsidebar.leaderboard') }}
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/weekly-quizz">
                    <i class="fa fa-stopwatch mr-3"></i>{{ __('lang.portalsidebar.weekly_quiz') }}
                </a>
            </li>

        </ul>
    </div>



</div> --}}
{{-- <div class="bg-white sidebar-css border-radius shadow overflow-hidden"> --}}
<div class="navbar navbar-expand-lg  border-radius bsnav bsnav-sidebar ">
    <button class="navbar-toggler toggler-spring"><span class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse  flex-column">
        <div class="sidebar-header p-3">
            <div class="row">
                <div class="col-4">
                    <img src="{{ asset('lms/app-assets') }}/images/logo/logo-u-white.png" alt="unilever-logo" class="img-fluid">
                </div>
                <div class="col-8">
                    <h3 class="mb-0">Learning Platform</h3>
                </div>
            </div>
        </div>
      <ul class="navbar-nav navbar-mobile mr-0">
        <li class="nav-item">
            <a class="nav-link" href="/student-profile">
                <i class="fa fa-user mr-3"></i>{{ __('lang.portalsidebar.my_profile') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/trainee-calendar">
                <i class="fa fa-calendar mr-3"></i>{{ __('lang.portalsidebar.my_training_calendar') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/leaderboard">
                <i class="fa fa-trophy mr-3"></i>{{ __('lang.portalsidebar.leaderboard') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/weekly-quizz">
                <i class="fa fa-stopwatch mr-3"></i>{{ __('lang.portalsidebar.weekly_quiz') }}
            </a>
        </li>
      </ul>
    </div>
</div>
{{-- </div> --}}

  <div class="bsnav-mobile">
    <div class="bsnav-mobile-overlay"></div>
    <div class="navbar"></div>
  </div>
