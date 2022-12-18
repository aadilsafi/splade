@extends('layouts.app')
@section('page-title', __('Forget Password'))
@section('content')
    <div class="auth-wrapper auth-cover">
        <div class="auth-inner row m-0">
            <!-- Brand logo-->
            <a class="brand-logo" href="/">
                <h2 class="brand-text text-primary ms-1">{{ config('app.name', '') }}</h2>
            </a>
            <!-- /Brand logo-->
            <!-- Left Text-->
            <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
                <div class="w-100 d-lg-flex align-items-center justify-content-center px-5">
                    <img class="img-fluid" src="../../../lms/app-assets/images/pages/forgot-password-v2.svg" alt="Forgot password V2"/>
                </div>
            </div>
            <!-- /Left Text-->
            <!-- Forgot password-->
            <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
                <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h2 class="card-title fw-bold mb-1">Forgot Password? 🔒</h2>
                    <p class="card-text mb-2">Enter your email and we'll send you instructions to reset your password</p>
                    <form class="auth-forgot-password-form mt-2" action="{{ route('password.email') }}" method="POST">
                        @csrf
                        <div class="mb-1">
                            <label class="form-label" for="forgot-password-email">Email</label>
                            <input class="form-control" id="forgot-password-email" type="text" name="email" placeholder="john@example.com" aria-describedby="forgot-password-email" autofocus="" tabindex="1"/>
                        </div>
                        <button class="btn btn-primary w-100" tabindex="2">Send Reset Link</button>
                    </form>
                    <p class="text-center mt-2">
                        <a href="{{route('login')}}">
                            <i data-feather="chevron-left"></i> Back to login
                        </a>
                    </p>
                </div>
            </div>
            <!-- /Forgot password-->
        </div>
    </div>
@endsection
