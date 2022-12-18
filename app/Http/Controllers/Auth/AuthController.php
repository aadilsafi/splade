<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\ProfileResource;
use App\Models\Profile;
use App\Models\User;
use App\Services\Interfaces\UserServiceInterface;
use App\Traits\LoginTrait;
use App\Utils\Common\UserRoles;
use App\Utils\FilePaths;
use App\Utils\Helper;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use DB;

class AuthController extends Controller
{
    //
    use LoginTrait;

    protected $UserService;
    public function __construct(UserServiceInterface $userService)
    {
        $this->UserService = $userService;
    }


    public function login(LoginRequest $request)
    {
        if (!auth()->attempt($this->credentials()))
        {
            return redirect()->back()->with('message',"Invalid Credentials");
        }

        return redirect()->route('home');

    }

    public function logout()
    {
        if (!auth()->user()) {
            return $this->sendError("Already Logged Out", ["Logout Fails"]);
        }

        // Revoke all tokens...
        auth()->user()->tokens()->delete();
        return $this->sendResponse(["Logout"], "Logout Successfully");
    }
    public function register(RegisterRequest $request)
    {

        $userData = $request->only('username','email');
        $userData['password'] = bcrypt($request->password);
        $user = $this->UserService->createUser();
        $profileData = $request->only('first_name','middle_name','last_name','avatar','date_of_birth','contact_email','bio');
        // if(!$auth)
        // {
        //     return $this->defaultRegisteration($userData,$profileData);
        // }
        return $this->adminUserRegistration($userData,$profileData,$request->roles);

    }
    public function defaultRegisteration($userData,$profileData)
    {
        DB::beginTransaction();
        try {
            $user = User::create($userData);
            if(isset($profileData['avatar']))
            {
                $profileData['avatar']  = $this->storeImage($profileData['avatar']);
            }
            $profile = $user->profile()->create($profileData);

            DB::commit();
            $user->assignRole(UserRoles::ALL[UserRoles::TRANIEE]);

            return $this->sendResponse(ProfileResource::make($user),'Registration Successfully');
        }
        catch (\Exception $exception) {
            Helper::log('### User - Registration - Exception ###', Helper::getExceptionInfo($exception));
            DB::rollBack();
            return $this->sendError('User Registration Error', ['Some error occurred while registering user. Please try later', $exception]);
        }
    }
    public function adminUserRegistration($userData,$profileData,$roles)
    {
        if($this->checkRegisterPermission($roles,$this->adminRegisterPermissions()))
        {
            DB::beginTransaction();
            try {
                $user = User::create($userData);
                if(isset($profileData['avatar']))
                {
                    $profileData['avatar']  = $this->storeImage($profileData['avatar']);
                }
                $profile = $user->profile()->create($profileData);

                $user->assignRole($roles);
                DB::commit();

                return $this->sendResponse(ProfileResource::make($user),'Registration Successfully');
            }
            catch (\Exception $exception) {
                Helper::log('### User - Registration - Exception ###', Helper::getExceptionInfo($exception));
                DB::rollBack();
                return $this->sendError('User Registration Error', ['Some error occurred while registering user. Please try later', $exception]);
            }
        }
        return $this->sendError('Registration Failed , Can not Assign some roles to User , You can Assign Only Roles',$this->adminRegisterPermissions());
    }


    public function superAdminRegisterPermissions()
    {
        return [
            'Admin',
            'Trainer',
            'Trainee'
        ];
    }
    public function adminRegisterPermissions()
    {
        return [
            'Trainer',
            'Trainee'
        ];
    }
    public function storeImage($image)
    {
        $image_name = time() . "_avatar." . $image->getClientOriginalExtension();
        $path       = FilePaths::PROFILES_DIRECTORY;
        return $image->storeAs($path,$image_name,'public');
    }
    public function me()
    {
        $auth = auth()->user();
        return $this->sendResponse(ProfileResource::make($auth),'Me');
    }
    //array have multiple value match return true
    public function checkRegisterPermission($needles, $haystack) {
        return !array_diff($needles, $haystack);
    }
}
