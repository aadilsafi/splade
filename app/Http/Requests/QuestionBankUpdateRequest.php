<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;

class QuestionBankUpdateRequest extends FormRequest
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
     * 
     * @return array
     */
    public function rules()
    {
        
        $id = request()->segment(2);
        return [
            'name' => 'nullable|unique:question_banks,name,'.$id,
            'slug' => 'nullable|unique:question_banks,slug,'.$id,
            // 'bingpo' => 'uni'
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
