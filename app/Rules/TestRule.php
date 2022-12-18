<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class TestRule implements Rule
{
    public function __construct()
    {
        
    }

    public function passes($attribute, $value)
    {
        if(true){
            return false;
        }
        return true;
    }

    public function message()
    {
        return 'The validation error message.';
    }
}
