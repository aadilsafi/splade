<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class RegisterRequest extends FormRequest
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
            'username'          =>    'required|string|min:3|max:20|unique:users,username',
            'email'             =>    'required|string|email:filter|unique:users,email|max:50',
            'password'          =>    'required|string|min:8|max:100',
            'first_name'        =>    'required|string|max:100',
            'middle_name'       =>    'nullable|string|max:100',
            'last_name'         =>    'nullable|string|max:100',
            'avatar'            =>    'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'date_of_birth'     =>    'required|date',
            'secondary_email'   =>    'nullable|email:filter',
            'contact_number'    =>    'nullable|numeric',
            'bio'               =>    'nullable|max:200',
            'roles'             =>    'nullable|array'
        ];
    }

    public function messages()
    {
        return [
            'first_name.string'         =>      'First Name contains Invalid Characters',
            'first_name.max'            =>      'First Name length is too long',
            'last_name.string'          =>      'Last Name contains Invalid Characters',
            'last_name.max'             =>      'Last Name length is too long',
            'email.max'                 =>      'Email length is too long',
            'email.unique'              =>      'The email you provided already exists. Please use another email',
            'email.email'               =>      'Email is not in correct format',
            'username.max'              =>      'Username length is too long',
            'username.unique'           =>      'The Username you provided already exists. Please use another',
            'username.string'           =>      'First Name contains Invalid Characters',
            'password.min'              =>      'Password value is too short',
            'password.max'              =>      'Password value is too long',
            'avatar.image'              =>      'Avatar must be image',
            'avatar.mimes'              =>      'Avatar Type must be PNG,JPG,JPEG',
            'avatar.max'                =>      'Avatar Size should be less than 2MB',
            'date_of_birth.required'    =>      'Date of Birth is Required',
            'date_of_birth.date'        =>      'Date of Birth must be a date',
            'secondary_email.email'     =>      'Secondary Email must be valid Email',
            'contact_number.numeric'    =>      'Contact Number is not valid',
            'bio.max'                   =>      'Bio length is too long',
            'roles.array'               =>      'Role must be array',
        ];
    }

    /**
     * Customize Form Request Errors for a consistent API response
     * @throws ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        if($this->expectsJson()){
            $errors = (new ValidationException($validator))->errors();

            throw new HttpResponseException(
                response()->json([
                    'success' => false,
                    'data'    => $errors,
                    'message' => 'Invalid data provided in the registration'
                ], 422)
            );
        }

        parent::failedValidation($validator);
    }
}
