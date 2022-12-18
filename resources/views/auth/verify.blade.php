@extends('layouts.app')

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
                    <img class="img-fluid" src="../../../lms/app-assets/images/illustration/verify-email-illustration.svg" alt="two steps verification"/>
                </div>
            </div>
            <!-- /Left Text-->
            <!-- verify email v2-->
            <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
                <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif
                    <h2 class="card-title fw-bolder mb-1">Verify your email &#x2709;&#xFE0F;</h2>
                    <p class="card-text mb-2">
                        Account activation link sent to your email address,
                        Please follow the link inside to continue.
                    </p>
                    <a class="btn btn-primary w-100" href="/">Skip for now</a>
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline"><span>Didn&apos;t receive an email?</span><span>&nbsp;Resend</span></button>.
                    </form>

                </div>
            </div>
            <!-- verify email-->
        </div>
    </div>
@endsection
