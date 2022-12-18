<?php


namespace App\ViewModel\Category;


use App\ViewModel\Category\Course\CourseViewModel;
use Illuminate\Support\Str;

class CategoryViewModel
{
    public $id;
    public $name;
    public $slug;
    public $parent;
    public $subCategories;
    public $position;
    public $courses;

    public static function getMultipleCategoriesViewModel($categories, $details = false)
    {
        $categoriesList = [];
        if($categories){
            foreach ($categories as $category){
                $categoriesList[] = self::getSingleCategoryViewModel($category, $details);
            }
        }

        return $categoriesList;
    }

    public static function getSingleCategoryViewModel($category, $details = true)
    {
        $categoryViewModel                    = new CategoryViewModel();
        $categoryViewModel->id                = $category->id;
        $categoryViewModel->name              = Str::title($category->name);
        $categoryViewModel->slug              = $category->slug;
        $categoryViewModel->position          = $category->position;
        $categoryViewModel->parent            = self::getSingleCategory($category->parentCategory);
        $categoryViewModel->subCategories     = $details? self::getSubCategories($category->subCategories) : $category->subCategories()->count();
        $categoryViewModel->courses           = $details? CourseViewModel::getMultipleCoursesViewModel($category->courses) : $category->courses()->count();
        return $categoryViewModel;
    }

    private static function getSingleCategory($category){
        $parent = [];
        if($category){
            $parent = [
                'id'        => $category->id,
                'name'      => $category->name,
                'slug'      => $category->slug,
                'position'  => $category->position,
            ];
        }
        return (object) $parent;
    }

    private static function getSubCategories($subCategories)
    {
        $allSubCategories = [];
        foreach ($subCategories as $category){
            $allSubCategories[] = self::getSingleCategory($category);
        }
        return $allSubCategories;
    }
}
