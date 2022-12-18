<?php

namespace App\Http\Requests;

use App\Rules\QuestionChoiceRule;
use Illuminate\Foundation\Http\FormRequest;

class QuestionStoreRequest extends FormRequest
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
                'name'                  => 'required|unique:questions,name',
                'difficulty_level_id'   => 'required|exists:difficulty_levels,id',
                'question_bank_id'      => 'required|exists:question_banks,id',
        ];
    }
    public function messages()
    {
        return [
            'name.unique' => 'Question Name Already Exist',
        ];
    }
}
