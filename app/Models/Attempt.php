<?php

namespace App\Models;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attempt extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $with = ['answer','question','quiz','user'];


    public function answer()
    {
    	return $this->hasOne(Answer::class,'id','answer_id');
    }
    public function question()
    {
    	return $this->belongsTo(Question::class);
    }
    public function quiz()
    {
        return $this->belongsTo(Quiz::class,'quiz_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

}
