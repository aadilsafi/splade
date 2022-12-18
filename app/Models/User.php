<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use  HasFactory, Notifiable,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getIsAdminAttribute()
    {
        return $this->hasRole('Admin');
    }

    public function getIsSuperAdminAttribute()
    {
        return $this->hasRole('Super Admin');
    }

    public function activities()
    {
        return $this->belongsToMany(Activity::class,'user_activities')->orderBy('position');
    }
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
    public function quizzes()
    {
        return $this->hasMany(Quiz::class,'trainer_id');
    }
    public function attempts()
    {
        return $this->hasMany(Attempt::class,'user_id');
    }
    public function courses()
    {
        return $this->belongsToMany(Course::class,'user_courses')->orderBy('position');
    }

    public function categories()
    {
        return $this->hasManyThrough(Category::class, Course::class, 'category_id', 'id', 'id', 'user_id');
    }

    public function activity_progress()
    {
        return $this->belongsToMany(Activity::class, 'user_progress');
    }

    public function topic_progress()
    {
        return $this->belongsToMany(Topic::class, 'user_progress');
    }
    public function quiz_reports()
    {
        return $this->hasMany(AttemptView::class,'user_id','id');
    }
}

User::updated(function($record){
    dd('update');
});
