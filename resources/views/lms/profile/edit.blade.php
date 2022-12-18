@extends('lms.layout.master')

@section('seo-breadcrumb')
    {{-- {{ Breadcrumbs::view('breadcrumbs::json-ld', 'sites.types.create', $site_id) }} --}}
@endsection

@section('page-title', 'Account Settings')

@section('page-css')
{{--    <link rel="stylesheet" type="text/css" href="../../../lms/app-assets/css/plugins/forms/form-validation.css">--}}
@endsection

@section('custom-css')
@endsection

@section('breadcrumbs')
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-start mb-0">Profile</h2>
                <div class="breadcrumb-wrapper">
                    {{ Breadcrumbs::render('profile.edit') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="content-body">
        <div class="row">
            <div class="col-12">
                <ul class="nav nav-pills mb-2">
                    <!-- account -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('profile.edit.account') ? 'active' : null }}" href="{{route('profile.edit.account', $user->username)}}">
                            <i data-feather="user" class="font-medium-3 me-50"></i>
                            <span class="fw-bold">Account</span>
                        </a>
                    </li>
                    <!-- security -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('profile.edit.security') ? 'active' : null }}" href="{{route('profile.edit.security', $user->username)}}">
                            <i data-feather="lock" class="font-medium-3 me-50"></i>
                            <span class="fw-bold">Security</span>
                        </a>
                    </li>
                </ul>

                @yield('sub-content')
            </div>
        </div>
    </div>
@endsection

@section('page-js')
{{--    <script src="../../../lms/app-assets/vendors/js/forms/validation/jquery.validate.min.js"></script>--}}
{{--    <script src="../../../lms/app-assets/js/scripts/pages/page-account-settings-security.min.js"></script>--}}
@endsection
