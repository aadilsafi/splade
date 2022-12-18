<?php

namespace App\Http\Requests\scorm;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class GetScormTrackRequest extends FormRequest
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
        return [];
    }
}
