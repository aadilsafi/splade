<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileSecurityUpdateRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\ViewModel\User\UserViewModel;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        //
    }

    public function edit(User $user)
    {
        if (!isset($user->id)) {
            $user = auth()->user();
        }

        $user = UserViewModel::getSingleUserViewModel($user);

        if (request()->routeIs('profile.edit.account')) {
            if (!$user->profile) {
                return redirect()->route('profile.edit.security');
            }
            return view('lms.profile.partials.account', compact('user'));
        }

        if (request()->routeIs('profile.edit.security')) {
            return view('lms.profile.partials.security', compact('user'));
        }

        return view('lms.profile.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
        //
    }

    public function updateProfile(ProfileUpdateRequest $request, User $user)
    {
        $user->profile()->update($request->validated());
        $this->createFlashMessage("Profile Updated", "success");
        return redirect()->back();
    }

    public function updateProfileSecurity(ProfileSecurityUpdateRequest $request, User $user)
    {
        $inputFields = $request->validated();
        unset($inputFields['old_password']);
        $inputFields['password'] = bcrypt($inputFields['password']);
        $user->update($inputFields);
        $this->createFlashMessage("Profile Security Updated", "success");
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
