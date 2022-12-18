@extends('lms.layout.master')
@section('page-title', __('lang.fields.user.singular'))

@section('page-vendor')
@endsection

@section('page-css')
@endsection

@section('custom-css')
@endsection

@section('breadcrumbs')
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-11">
                <h2 class="content-header-title float-start mb-0">{{__('lang.commons.add')}}</h2>
                <div class="breadcrumb-wrapper">
                    {{Breadcrumbs::render('user.create') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="content-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h4 class="card-title">User Details</h4>
                    </div>
                    <div class="card-body py-2 my-25">
                        <!-- header section -->
{{--                        <div class="d-flex">--}}
{{--                            <a href="#" class="me-25">--}}
{{--                                <img--}}
{{--                                    src="{{$user->profile->avatar}}"--}}
{{--                                    id="account-upload-img"--}}
{{--                                    class="uploadedAvatar rounded me-50"--}}
{{--                                    alt="profile image"--}}
{{--                                    height="100"--}}
{{--                                    width="100"--}}
{{--                                />--}}
{{--                            </a>--}}
{{--                            <!-- upload and reset button -->--}}
{{--                            <div class="d-flex align-items-end mt-75 ms-1">--}}
{{--                                <div>--}}
{{--                                    <label for="account-upload"--}}
{{--                                           class="btn btn-sm btn-primary mb-75 me-75">Upload</label>--}}
{{--                                    <input type="file" id="account-upload" name="avatar" hidden accept="image/*"/>--}}
{{--                                    <button type="button" id="account-reset"--}}
{{--                                            class="btn btn-sm btn-outline-secondary mb-75">Reset--}}
{{--                                    </button>--}}
{{--                                    <p class="mb-0">Allowed file types: png, jpg, jpeg.</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <!--/ upload and reset button -->--}}
{{--                        </div>--}}
                        <!--/ header section -->

                        <!-- form -->
                        <form class="validate-form" method="post" action="{{isset($user)? route('user.update.profile', $user->username) : route('user.store')}}">
                            @csrf
                            @isset($user)
                                @method('PUT')
                            @endisset

                            <div class="row">
                                @include('lms.users.form-fields')
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary mt-1 me-1">Create</button>
                                    <button type="reset" class="btn btn-outline-secondary mt-1">Discard</button>
                                </div>
                            </div>
                        </form>
                        <!--/ form -->
                    </div>
                </div>
            </div>
        </div>
@endsection
