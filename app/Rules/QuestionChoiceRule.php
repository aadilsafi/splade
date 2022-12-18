<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class QuestionChoiceRule implements Rule
{
    public function __construct()
    {
        
    }

    public function passes($attribute, $choices)
    {
        $totalCounts = array_count_values($choices);
        if(isset($totalCounts['1']) && $totalCounts['1'] > 1)
        {
            return false;
        }
        
        if(isset($totalCounts['0']) && $totalCounts['0'] > 3)
        {
            return false;
        }
        return true;
    }

    public function message()
    {
        return 'The :attribute contains only one value true';
    }
}
