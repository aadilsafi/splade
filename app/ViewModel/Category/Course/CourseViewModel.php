<?php


namespace App\ViewModel\Category\Course;


use App\ViewModel\Category\CategoryViewModel;
use App\ViewModel\Category\Course\Topic\Activity\ActivityViewModel;
use App\ViewModel\Category\Course\Topic\TopicViewModel;
use App\ViewModel\Profile\ProfileViewModel;
use App\ViewModel\User\UserViewModel;
use App\Utils\Common\CourseStatus;
use App\Utils\FilePaths;
use App\Utils\Helper;
use Illuminate\Support\Str;

class CourseViewModel
{
    public $id;
    public $title;
    public $description;
    public $slug;
    public $position;
    public $course_code;
    public $category;
    public $cover_image;
    public $is_active;
    public $status;

    public $author;
    public $trainer;
    public $topics;
    public $user_course_progress;

    public static function getMultipleCoursesViewModel($courses, $details = false)
    {

        $coursesList = [];
        if ($courses) {
            foreach ($courses as $course) {
                $coursesList[] = self::getSingleCourseViewModel($course, $details);
            }
        }

        return $coursesList;
    }

    public static function getSingleCourseViewModel($course, $details = true)
    {       
        $courseViewModel                        = new CourseViewModel();
        $courseViewModel->id                    = $course->id;
        $courseViewModel->cover_image           = $course->cover_image ? asset($course->cover_image) : asset(FilePaths::DEFAULT_COURSE_IMAGE);
        $courseViewModel->title                 = Str::title($course->title);
        $courseViewModel->slug                  = $course->slug;
        $courseViewModel->description           = $course->description;
        $courseViewModel->position              = $course->position;
        $courseViewModel->course_code           = $course->course_code;
        $courseViewModel->author                = $course->author ?: "-";
        $courseViewModel->is_active             = $course->is_active;
        $courseViewModel->status                = Helper::getConstantData($course->status, CourseStatus::ALL);
        $courseViewModel->category              = (object)['id' => $course->category->id, 'slug' => $course->category->slug, 'name' => $course->category->name];
        $courseViewModel->category_slug         = !$details ? $course->category->slug : null;
        $courseViewModel->topics                = $details ? TopicViewModel::getMultipleTopicsViewModel($course->topics, $details) : $course->topics()->count();
        $courseViewModel->users                 = $course->users()->count();
        $courseViewModel->user_last_topic       = TopicViewModel::getSingleTopicViewModel(auth()->user()->topic_progress->where('course_id', $course->id)->last(), $details);
        $courseViewModel->user_course_progress  = (auth()->user()->activity_progress()->where('course_id', $course->id)->count() / ($course->activities()->count() == 0 ? 1 :$course->activities()->count())) * 100;
        return $courseViewModel;
    }
}
