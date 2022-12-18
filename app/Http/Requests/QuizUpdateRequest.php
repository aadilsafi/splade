<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuizUpdateRequest extends FormRequest
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
            'name' 		 => 'nullable',
    		'duration' 	 => 'nullable',
    		'start_date' => 'nullable|before:end_date',
    		'end_date'	 => 'nullable|after:start_date',
			'total_questions' => 'nullable|numeric',
    		'total_marks' => 'nullable|gte:passing_marks',
    		'passing_marks' => 'nullable|lte:total_marks'
        ];
    }
    public function messages()
    {
        return [
            'start_date.before' => 'Quiz Start Date must be a date before End Date',
            'end_date.after' => 'Quiz End Date must be a date after Start Date',
            'total_marks.gte' => 'Total Marks must greater than passing marks',
            'passing_marks.lte' => 'Passing Marks must be less than Total Marks'
        ];
    }
}
