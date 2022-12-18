<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class ProfileSecurityUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username'          =>    'required|string|min:3|max:20|unique:users,username,'. $this->user->id,
            'email'             =>    'required|string|max:50|email:filter|unique:users,email,'. $this->user->id,
            'old_password'      =>    ['required', function ($attribute, $value, $fail) {
                                            if (!Hash::check($value, $this->user->password)) {
                                                $fail('Old Password didn\'t match');
                                            }
                                      }],
            'password'          =>    'required|string|min:8|max:100',
            'roles'             =>    'nullable|array'
        ];
    }

    private function checkOldPassword($attribute, $value, $fail)
    {

    }

    public function messages()
    {
        return [
            'username.max'              =>      'Username length is too long',
            'username.unique'           =>      'The Username you provided already exists. Please use another',
            'username.string'           =>      'First Name contains Invalid Characters',
            'email.max'                 =>      'Email length is too long',
            'email.unique'              =>      'The email you provided already exists. Please use another email',
            'email.email'               =>      'Email is not in correct format',
            'old_password.required'     =>      'Please provide old password',
            'password.required'         =>      'New Password is required',
            'password.min'              =>      'Password value is too short',
            'password.max'              =>      'Password value is too long',
            'roles.array'               =>      'Role must be array',
        ];
    }
}
