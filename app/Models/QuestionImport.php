<?php

namespace App\Models;
use App\Models\Category;
use App\Models\QuestionBank;
use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionImport extends Model
{
    use HasFactory;
    protected $guarded= [];
    protected $table = 'question_imports';
    public function category()
    {
        return $this->hasOne(Category::class,'id','category_id');
    }
    public function bank()
    {
        return $this->hasOne(QuestionBank::class,'id','question_bank_id');
    }
    public function answers()
    {
        return $this->hasMany(Answer::class,'id');
    }
}
