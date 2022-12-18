<?php

namespace App\Models;

use App\Models\Answer;
use App\Models\Category;
use App\Models\QuestionBank;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'difficulty_level_id',
        'question_bank_id',
    ];
    protected $columns = ['id','name'];
    public function answers()
    {
    	return $this->hasMany(Answer::class);
    }
    public function difficultyLevel()
    {
        return $this->hasOne(DifficultyLevel::class,'id','difficulty_level_id');
    }
    public function bank()
    {
        return $this->hasOne(QuestionBank::class,'id','question_bank_id');
    }
    public function attempt()
    {
        return $this->hasOne(Attempt::class);
    }
    public function quizzes()
    {
        return $this->belongsToMany(Quiz::class,'quiz_questions')->withPivot('marks');
    }
}
