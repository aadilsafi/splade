@extends('lms.profile.edit')

@section('sub-content')
    <!-- security -->
    <div class="card">
        <div class="card-header border-bottom">
            <h4 class="card-title">Account Security</h4>
        </div>
        <div class="card-body pt-1">
            <!-- form -->
            <form class="validate-form mt-2 pt-50" method="post" action="{{route('user.update.profile.security', $user->username)}}">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 col-12 mb-1">
                        <label class="form-label" for="username">User Name</label>
                        <input
                            type="text"
                            class="form-control"
                            id="username"
                            name="username"
                            value="{{$user->username ?: old('username')}}"
                            placeholder="Enter username"
                        />
                    </div>
                    <div class="col-md-6 col-12 mb-1">
                        <label class="form-label" for="email">Email</label>
                        <input
                            type="email"
                            class="form-control"
                            id="email"
                            name="email"
                            value="{{$user->email ?: old('email')}}"
                            placeholder="Enter email"
                        />
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12 col-12 mb-1">
                        <label class="form-label" for="old_password">Current password</label>
                        <div class="input-group form-password-toggle input-group-merge">
                            <input
                                type="password"
                                class="form-control"
                                id="old_password"
                                name="old_password"
                                value="{{old('old_password')}}"
                                placeholder="Enter current password"
                                data-msg="Please current password"
                            />
                            <div class="input-group-text cursor-pointer">
                                <i data-feather="eye"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-6 mb-1">
                        <label class="form-label" for="account-new-password">New Password</label>
                        <div class="input-group form-password-toggle input-group-merge">
                            <input
                                type="password"
                                id="account-new-password"
                                name="password"
                                value="{{old('password')}}"
                                class="form-control"
                                placeholder="Enter new password"
                            />
                            <div class="input-group-text cursor-pointer">
                                <i data-feather="eye"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 mb-1">
                        <label class="form-label" for="account-retype-new-password">Retype New Password</label>
                        <div class="input-group form-password-toggle input-group-merge">
                            <input
                                type="password"
                                class="form-control"
                                id="account-retype-new-password"
                                name="confirm-new-password"
                                value="{{old('confirm-new-password')}}"
                                placeholder="Confirm your new password"
                            />
                            <div class="input-group-text cursor-pointer"><i data-feather="eye"></i></div>
                        </div>
                    </div>
                    <div class="col-12">
                        <p class="fw-bolder">Password requirements:</p>
                        <ul class="ps-1 ms-25">
                            <li class="mb-50">Minimum 8 characters long - the more, the better</li>
                            <li class="mb-50">At least one lowercase character</li>
                            <li>At least one number, symbol, or whitespace character</li>
                        </ul>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary me-1 mt-1">Save changes</button>
                        <button type="reset" class="btn btn-outline-secondary mt-1">Discard</button>
                    </div>
                </div>
            </form>
            <!--/ form -->
        </div>
    </div>
@endsection
