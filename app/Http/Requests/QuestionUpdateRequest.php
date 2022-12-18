<?php

namespace App\Http\Requests;

use App\Rules\QuestionChoiceRule;
use Illuminate\Foundation\Http\FormRequest;

class QuestionUpdateRequest extends FormRequest
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
            'question' => 'nullable',
            'difficulty_level_id' => 'nullable|exists:difficulty_levels,id',
        ];
    }
    public function messages()
    {
        return [
            'is_corrects.*.boolean' => 'Options should be true or false',
        ];
    }
}
