@extends('layouts.static')
@section('seo-breadcrumb')
{{--{{ Breadcrumbs::view('breadcrumbs::json-ld', 'home') }}--}}
@endsection

@section('page-title', 'Home')

@section('page-vendor')
<link rel="stylesheet" type="text/css" href="{{ asset('lms/app-assets') }}/vendors/css/charts/apexcharts.css">
@endsection

@section('page-css')
<link rel="stylesheet" type="text/css" href="{{ asset('lms/app-assets') }}/css/pages/dashboard-ecommerce.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('lms/app-assets') }}/css/plugins/charts/chart-apex.min.css">
@endsection

@section('custom-css')
@endsection

@section('seo-breadcrumb')
{{--{{ Breadcrumbs::view('breadcrumbs::json-ld', 'home') }}--}}
@endsection

@section('content')
{{-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

<div class="card-body">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif

    {{ __('You are logged in!') }}
</div>
</div>
</div>
</div> --}}
<section class="card-select py-5">


  <div class="h-100">
  <div class="d-flex align-items-center justify-content-center h-100">
        <div class="container">
            <h2 class="text-center ">
                Welcome, {{auth()->user()->username}}!
            </h2>
            @if(!auth()->user()->isAdmin)
                <h3 class="text-center mb-4 ">Where do you want to go?</h3>
            @endif
            <div class="row">
                <div class="col-md-3 offset-md-3 mb-3">
                    <div id="lms-card">
                    <a href="/dashboard">
                        <div class="u-card selection-card lms">
                            <img src="/images/lesson.svg" class="img-fluid">
                            LMS
                        </div>
                    </a>
                    </div>
                </div>
                @if(!auth()->user()->isAdmin)
                    <div class="col-md-3">
                        <div id="quiz-card">
                        <a href="/student-profile">
                            <div class="u-card selection-card">
                                <img src="/images/quiz.svg" class="img-fluid">
                                Quiz
                            </div>
                        </a>
                        </div>
                    </div>
                @endif
            </div>
            <!-- <button class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
            </button> -->
        </div>
    </div>
  </div>
</section>

@endsection

@section('page-js')
<script>
    $( document ).ready(function() {
        var tl = gsap.timeline();
        tl.from("#lms-card", { scale: 0, duration: 0.5, ease: 'ease-in-out'});
        tl.from("#quiz-card", { scale: 0, duration: 0.5, ease: 'ease-in-out'},">-0.2");
    });
</script>
@endsection
