<?php

namespace App\Http\Requests\scorm;

use Illuminate\Foundation\Http\FormRequest;

class ScormCreateRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'zip' => ['file', 'required', 'mimes:zip'],
        ];
    }
}
