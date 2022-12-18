<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="username">Username</label>
    <input
        type="text"
        class="form-control"
        id="username"
        name="username"
        value="{{isset($user)? $user->username : old('username')}}"
        placeholder="Please enter username"
    />
</div>
<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="email">Email</label>
    <input
        type="email"
        class="form-control"
        id="email"
        name="email"
        value="{{isset($user)? $user->email : old('email')}}"
        placeholder="Please enter primary email"
    />
</div>
<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="password">Password</label>
    <input
        type="password"
        class="form-control"
        id="password"
        name="password"
        value="{{old('password')}}"
        placeholder="Please enter password"
    />
</div>
<div class="divider my-2">
    <div class="divider-text">Profile Details</div>
</div>



<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="first_name">First Name</label>
    <input
        type="text"
        class="form-control"
        id="first_name"
        name="first_name"
        value="{{isset($user)? $user->profile->first_name : old('first_name')}}"
        placeholder="Please enter first name"
    />
</div>
<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="middle_name">Middle Name</label>
    <input
        type="text"
        class="form-control"
        id="middle_name"
        name="middle_name"
        value="{{isset($user)? $user->profile->middle_name : old('middle_name')}}"
        placeholder="Please enter middle name"
    />
</div>
<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="last_name">Last Name</label>
    <input
        type="text"
        class="form-control"
        id="last_name"
        name="last_name"
        value="{{isset($user)? $user->profile->last_name : old('last_name')}}"
        placeholder="Please enter last name"
    />
</div>
<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="contact_number">Contact Number</label>
    <input
        type="text"
        class="form-control"
        id="contact_number"
        name="contact_number"
        placeholder="Please enter contact number"
        value="{{isset($user)? $user->profile->contact_number : old('contact_number')}}"
    />
</div>
<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="secondary_email">Secondary Email</label>
    <input
        type="email"
        class="form-control"
        id="secondary_email"
        name="secondary_email"
        placeholder="Please enter secondary email"
        value="{{isset($user)? $user->profile->secondary_email : old('secondary_email')}}"
    />
</div>
<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="date_of_birth">Date Of Birth</label>
    <input
        type="date"
        class="form-control"
        id="date_of_birth"
        name="date_of_birth"
        placeholder="Please Provide Date of Birth"
        value="{{isset($user)? $user->profile->date_of_birth : old('date_of_birth')}}"
    />
</div>
<div class="col-12 col-sm-12 mb-1">
    <label class="form-label" for="bio">Bio</label>
    <textarea
        name="bio"
        class="form-control"
        id="bio"
        cols="30"
        rows="10"
        placeholder="Tell us about you">{{isset($user)? $user->profile->bio : old('bio')}}</textarea>
</div>
