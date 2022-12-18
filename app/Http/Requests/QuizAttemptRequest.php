<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuizAttemptRequest extends FormRequest
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
            'quiz_id'      => 'required|numeric|exists:quizzes,id',
            'answer_ids'   => 'required|array',
            'answer_ids.*' => 'numeric|exists:answers,id',
            'topic_id'     => 'required|exists:topics,id',
            'activity_id'  => 'required|exists:activities,id'
        ];
    }
    public function messages()
    {
        return [
            'quiz_id.required' => 'Quiz is Required',
            'quiz_id.exists'   => 'Invalid Quiz',
            'topic_id.exist'   => 'Topic Does not Exist',
            'activity_id.exist'   => 'Activity Does not Exist',
            'answer_ids.*.exists'       => 'Answer is Not Exists for The Question'
        ];
    }
}
