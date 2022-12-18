<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class CategoryRequest extends FormRequest
{
    public function rules()
    {
        if($this->request->get('parent_id') == "Null"){
        return [
            'name'           => 'required',
            'slug'           => 'required',
        ];
    }else{
        return [
            'name'           => 'required',
            'slug'           => 'required',
            'parent_id'      => 'nullable|exists:categories,id',
        ];
    }

    }

    protected function failedValidation(Validator $validator)
    {
        if ($this->expectsJson()) {
            $errors = (new ValidationException($validator))->errors();

            throw new HttpResponseException(
                response()->json([
                    'success' => false,
                    'data'    => $errors,
                    'message' => 'Invalid data provided in the topic creation'
                ], 422)
            );
        }

        parent::failedValidation($validator);
    }
}
