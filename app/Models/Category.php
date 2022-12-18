<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function subCategories()
    {
        return $this->hasMany(Category::class,'parent_id')
            ->with('subCategories')
            ->orderBy('parent_id')
            ->orderBy('position');
    }
    public function parentCategory()
    {
        return $this->belongsTo(Category::class,'parent_id');
    }

    public function courses()
    {
        return $this->hasMany(Course::class)
            ->orderBy('category_id')
            ->orderBy('position');
    }
}
