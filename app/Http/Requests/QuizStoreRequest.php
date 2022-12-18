<?php

namespace App\Http\Requests;

use App\Rules\QuizMarksRule;
use Illuminate\Foundation\Http\FormRequest;

class QuizStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    protected $isQuestionMarks;
    public function __construct($isQuestionMarks = false)
    {
        $this->isQuestionMarks = $isQuestionMarks;
    }
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
        
        $rules =  [
            'name' 		 => 'required',
    		'duration' 	 => 'required',
    		'start_date' => 'required|date|before:end_date',
    		'end_date'	 => 'required|date|after:start_date',
    		'total_marks' => 'required|gte:passing_marks',
    		'passing_marks' => 'required|lte:total_marks',
            
        ];
        if($this->isQuestionMarks)
        {
            // dump(request()->input('start_date'));
            // dd(request()->input('end_date'));
            $rules['duration'] = 'nullable|numeric';
            $rules['start_date'] = 'required|date_format:Y-m-d H:i';
            $rules['end_date'] = 'required|date_format:Y-m-d H:i|after:start_date';
            $rules['total_marks'] = 'required|gte:passing_marks|in:'.array_sum(request()->input('marks') ?? []);
            $questionMarksRule = [
                //these below validation is from LMS site
                'question_ids'  => 'required|array',
                'question_ids.*'  => 'required|numeric|exists:questions,id',
                'marks'  => 'required|array',
                'marks.*'  => 'required|numeric',
                'bank_ids' => 'nullable|array'
            ];
            $rules = array_merge($rules,$questionMarksRule);
        }
        return $rules;
    }
    public function messages()
    {
        return [
            'start_date.before' => 'Quiz Start Date must be a date before End Date',
            'end_date.after' => 'Quiz End Date must be a date after Start Date',
            'total_marks.gte' => 'Total Marks must greater than passing marks',
            'passing_marks.lte' => 'Passing Marks must be less than Total Marks',
            'question_ids.required' => 'Questions are Required',
            'question_ids.*.required' => 'Question are Required',
            'question_ids.array' => 'Invalid Question Data',
            'marks.*' => 'Question Marks is Required',
            'total_marks.same' => 'The Total marks must be equal to Sum of All Question Marks',
            'total_marks.in' => 'Total Marks must be equal to Sum of All Question Marks',
            'start_date.date_format' => 'Start Date Format Must Be Matched with YYYY-MM-DD HOUR:MINUTES',
            'end_date.date_format' => 'End Date Format Must Be Matched with YYYY-MM-DD HOUR:MINUTES'
        ];
    }
}
