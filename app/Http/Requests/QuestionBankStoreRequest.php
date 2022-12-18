<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionBankStoreRequest extends FormRequest
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
            //
            'name' => 'required|unique:question_banks,name',
            'slug' => 'required|unique:question_banks,slug',
        ];
    }
    public function messages()
    {
        return [
            'name.unique' => 'Question Bank Name Already Exist! Please Try Another',
            'slug.unique' => 'Question Bank Slug Already Exist! Please Try Another',
        ];
    }
}
