<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email'         =>    'required|string|max:50',
            'password'      =>    'required|string|min:8|max:100',
            // 'remember'      =>    'nullable|boolean'
        ];
    }
    public function messages()
    {
        return [
            'email.max'             =>      'Email length is too long',
            'email.email'           =>      'Email is not in correct format',
            'password.min'          =>      'Password value is too short',
            'password.max'          =>      'Password value is too long',
        ];
    }
}
