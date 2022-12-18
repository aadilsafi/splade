<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
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
            'first_name'        =>    'required|string|max:100',
            'middle_name'       =>    'nullable|string|max:100',
            'last_name'         =>    'nullable|string|max:100',
            'date_of_birth'     =>    'required|date',
            'secondary_email'   =>    'nullable|email:filter',
            'contact_number'    =>    'nullable|numeric',
            'bio'               =>    'nullable|max:200',
        ];
    }

    public function messages()
    {
        return [
            'first_name.string'         =>      'First Name contains Invalid Characters',
            'first_name.max'            =>      'First Name length is too long',
            'last_name.string'          =>      'Last Name contains Invalid Characters',
            'last_name.max'             =>      'Last Name length is too long',
            'date_of_birth.required'    =>      'Date of Birth is Required',
            'date_of_birth.date'        =>      'Date of Birth must be a date',
            'secondary_email.email'     =>      'Secondary Email must be valid Email',
            'contact_number.numeric'    =>      'Contact Number is not valid',
            'bio.max'                   =>      'Bio length is too long',
        ];
    }
}
