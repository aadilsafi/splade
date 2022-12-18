<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function content()
    {
        return $this->morphTo('activity','activity_type');
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }
}
