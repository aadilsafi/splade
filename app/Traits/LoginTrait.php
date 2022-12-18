<?php

namespace App\Traits;

use Illuminate\Http\Request;

/**
 * Username or Email
 */
trait LoginTrait
{
    public function username()
    {
        $email = request()->input('email');
        $fieldType = filter_var($email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        request()->merge([$fieldType => $email]);
        return $fieldType;
       
    }
    
    protected function credentials()
    {
        return request()->only($this->username(), 'password');
    }
    protected function generateToken($user)
    {
        // Revoke all tokens...
        $user->tokens()->delete();

        $token = $user->createToken("stra")->plainTextToken;
        $user->token = "Bearer " . $token;
        return $user;
    }
}
