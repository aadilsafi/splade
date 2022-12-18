<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class CourseRequest extends FormRequest
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
            'title'             => 'required',
            'description'       => 'nullable',
            'slug'              => 'required',
            'course_code'       => 'required',
            'author'         => 'required',
            // 'author_id'         => 'required',
            // 'trainer_id'        => 'required',
            // 'category_id'       => 'required',
            'cover_image'       => 'nullable|image|mimes:png,jpg,jpeg',
            // 'is_active'         => 'boolean',
            'status'            => 'nullable',
            'redirect_to_show'           => 'nullable'
        ];
    }

    // protected function failedValidation(Validator $validator)
    // {
    //     if ($this->expectsJson()) {
    //         $errors = (new ValidationException($validator))->errors();

    //         throw new HttpResponseException(
    //             response()->json([
    //                 'success' => false,
    //                 'data'    => $errors,
    //                 'message' => 'Invalid data provided in the Course Creation'
    //             ], 422)
    //         );
    //     }

    //     parent::failedValidation($validator);
    // }
}
