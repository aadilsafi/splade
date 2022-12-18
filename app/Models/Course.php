<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function category()
    {
        return $this->belongsTo(Category::class)->orderBy('position');
    }

    public function topics()
    {
        return $this->hasMany(Topic::class)->orderBy('position');
    }

    public function activities()
    {
        return $this->hasManyThrough(Activity::class,Topic::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class,'user_courses')->withPivot('enrollment_type')->withTimestamps();;
    }
}
