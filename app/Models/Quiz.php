<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;
    protected $guarded = [];

    // protected $with = ['attempts'];
    public function instructor()
    {
    	return $this->belongsTo(User::class);
    }

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'quiz_questions')->withTimeStamps()->withPivot('marks');
    }
    public function attempts()
    {
        return $this->hasMany(Attempt::class);
    }
}
