<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
    use HasFactory;

    public function answers()
    {
        return $this->hasManyThrough(Answer::class,Question::class,'id','question_id');
    }
}
