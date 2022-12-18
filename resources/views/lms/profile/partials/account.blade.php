@extends('lms.profile.edit')

@section('sub-content')
    <!-- profile -->
    <div class="card">
        <div class="card-header border-bottom">
            <h4 class="card-title">Profile Details</h4>
        </div>
        <div class="card-body py-2 my-25">
            <!-- header section -->
            <div class="d-flex">
                <a href="#" class="me-25">
                    <img
                        src="{{$user->profile->avatar}}"
                        id="account-upload-img"
                        class="uploadedAvatar rounded me-50"
                        alt="profile image"
                        height="100"
                        width="100"
                    />
                </a>
                <!-- upload and reset button -->
                <div class="d-flex align-items-end mt-75 ms-1">
                    <div>
                        <label for="account-upload" class="btn btn-sm btn-primary mb-75 me-75">Upload</label>
                        <input type="file" id="account-upload" name="avatar" hidden accept="image/*" />
                        <button type="button" id="account-reset" class="btn btn-sm btn-outline-secondary mb-75">Reset</button>
                        <p class="mb-0">Allowed file types: png, jpg, jpeg.</p>
                    </div>
                </div>
                <!--/ upload and reset button -->
            </div>
            <!--/ header section -->

            <!-- form -->
            <form class="validate-form mt-2 pt-50" method="post" action="{{route('user.update.profile', $user->username)}}">
                @csrf
                @method('PUT')
                <div class="row">
                    @include('lms.profile.partials.profile_fields', ['profile' => $user->profile])
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary mt-1 me-1">Save changes</button>
                        <button type="reset" class="btn btn-outline-secondary mt-1">Discard</button>
                    </div>
                </div>
            </form>
            <!--/ form -->
        </div>
    </div>
@endsection
