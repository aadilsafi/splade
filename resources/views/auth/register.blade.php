@extends('layouts.app')
@section('page-title', __('Register'))
@section('content')
    <div class="auth-wrapper auth-cover">
        <div class="auth-inner row m-0">
            <!-- Brand logo-->
            <a class="brand-logo" href="index-2.html">
                <img src="{{asset('lms/app-assets/images/logo/logo_2.png')}}" style="object-fit:cover; height:27px">    
            </a>
            <!-- /Brand logo-->
            <!-- Left Text-->
            <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
                <div class="w-100 d-lg-flex align-items-center justify-content-center px-5"><img class="img-fluid" src="../../../lms/app-assets/images/pages/register-v2.svg" alt="Register V2"/></div>
            </div>
            <!-- /Left Text-->
            <!-- Register-->
            <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
                <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                    <h2 class="card-title fw-bold mb-1">Adventure starts here 🚀</h2>
                    <p class="card-text mb-2">Make your app management easy and fun!</p>
                    <form class="auth-register-form mt-2" action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="mb-1">
                            <label class="form-label" for="register-username">Username</label>
                            <input class="form-control" id="register-username" type="text" name="username" placeholder="johndoe" aria-describedby="register-username" autofocus="" tabindex="1"/>
                        </div>
                        <div class="mb-1">
                            <label class="form-label" for="register-email">Email</label>
                            <input class="form-control" id="register-email" type="text" name="email" placeholder="john@example.com" aria-describedby="register-email" tabindex="2"/>
                        </div>
                        <div class="mb-1">
                            <label class="form-label" for="register-password">Password</label>
                            <div class="input-group input-group-merge form-password-toggle">
                                <input class="form-control form-control-merge" id="register-password" type="password" name="password" placeholder="············" aria-describedby="register-password" tabindex="3"/><span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                            </div>
                        </div>
                        <div class="mb-1">
                            <div class="form-check">
                                <input class="form-check-input" id="register-privacy-policy" type="checkbox" tabindex="4"/>
                                <label class="form-check-label" for="register-privacy-policy">I agree to<a href="#">&nbsp;privacy policy & terms</a></label>
                            </div>
                        </div>
                        <button class="btn btn-primary w-100" tabindex="5">Sign up</button>
                    </form>
                    <p class="text-center mt-2">
                        <span>Already have an account?</span>
                        @if (Route::has('login'))
                            <a href="{{ route('login') }}"><span>&nbsp;{{ __('Login') }}</span></a>
                        @endif
                    </p>
                    <div class="divider my-2">
                        <div class="divider-text">or</div>
                    </div>
                    <div class="auth-footer-btn d-flex justify-content-center">
                        <a class="btn btn-facebook" href="#"><i data-feather="facebook"></i></a>
                        <a class="btn btn-twitter white" href="#"><i data-feather="twitter"></i></a>
                        <a class="btn btn-google" href="#"><i data-feather="mail"></i></a>
                        <a class="btn btn-github" href="#"><i data-feather="github"></i></a>
                    </div>
                </div>
            </div>
            <!-- /Register-->
        </div>
    </div>
@endsection
