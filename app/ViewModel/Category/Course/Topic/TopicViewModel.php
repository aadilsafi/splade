<?php


namespace App\ViewModel\Category\Course\Topic;


use App\ViewModel\Category\Course\CourseViewModel;
use App\ViewModel\Category\Course\Topic\Activity\ActivityViewModel;
use Illuminate\Support\Str;

class TopicViewModel
{
    public $id;
    public $title;
    public $slug;
    public $description;
    public $position;
    public $course;
    public $activities;
    public $user_topic_progress;

    public static function getMultipleTopicsViewModel($topics, $details = false)
    {
        $topicsList = [];
        if ($topics) {
            foreach ($topics as $topic) {
                $topicsList[] = self::getSingleTopicViewModel($topic, true);
            }
        }

        return $topicsList;
    }

    public static function getSingleTopicViewModel($topic, $details = true)
    {
        if (!$topic){
            return null;
        }
        $topicViewModel                         = new TopicViewModel();
        $topicViewModel->id                     = $topic->id;
        $topicViewModel->title                  = Str::title($topic->title);
        $topicViewModel->slug                   = $topic->slug;
        $topicViewModel->position               = $topic->position;
        $topicViewModel->description            = $topic->description;
        $topicViewModel->course                 = ['id'=>$topic->course->id, 'slug' => $topic->course];
        $topicViewModel->activities             = $details ? ActivityViewModel::getMultipleActivitiesViewModel($topic->activities) : $topic->activities()->count();
        $topicViewModel->user_last_activity     = ActivityViewModel::getSingleActivityViewModel(auth()->user()->activity_progress->where('topic_id', $topic->id)->last(), $details);
        $topicViewModel->user_topic_progress    = (auth()->user()->activity_progress->where('topic_id', $topic->id)->count() / $topic->activities()->count()) * 100;
        return $topicViewModel;
    }
}
