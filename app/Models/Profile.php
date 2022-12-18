<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $fillable = [
        'avatar',
        'first_name',
        'middle_name',
        'last_name',
        'date_of_birth',
        'contact_number',
        'secondary_email',
        'bio',
        'score',
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
