<?php


namespace App\ViewModel\Category\Course\Topic\Activity;


use App\ViewModel\Category\Course\Topic\Activity\Content\Quiz\QuizViewModel;
use App\ViewModel\Category\Course\Topic\Activity\Content\ResourceViewModel;
use App\ViewModel\Category\Course\Topic\Activity\Content\WysiwigViewModel;
use App\ViewModel\Category\Course\Topic\TopicViewModel;
use App\Models\Resource;
use App\Models\Wysiwig;
use App\Services\ScormService;
use App\Services\ScormTrackService;
use App\Utils\Common\ActivityTypes;
use App\Utils\Helper;
use Illuminate\Support\Str;
use Peopleaps\Scorm\Model\ScormModel;

class ActivityViewModel
{
    public $id;
    public $title;
    public $slug;
    public $position;
    public $description;
    public $activity_id;
    public $type;
    public $is_record;
    public $topic;
    public $content;
    public $marked_completed;

    public static function getMultipleActivitiesViewModel($activities)
    {
        $activitiesList = [];
        if($activities){
            foreach ($activities as $activity){
                $activitiesList[] = self::getSingleActivityViewModel($activity);
            }
        }

        return $activitiesList;
    }

    public static function getSingleActivityViewModel($activity, $details = true)
    {
        if (!$activity){
            return null;
        }

        $activityViewModel                    = new ActivityViewModel();
        $activityViewModel->id                = $activity->id;
        $activityViewModel->title             = Str::title($activity->title);
        $activityViewModel->slug              = $activity->slug;
        $activityViewModel->position          = $activity->position;
        $activityViewModel->description       = $activity->description;
        $activityViewModel->is_record         = $activity->is_record;
        $activityViewModel->activity_id       = $activity->activity_id;
        $activityViewModel->marked_completed  = auth()->user()->activity_progress->contains($activity);
        $activityViewModel->type              = Helper::getConstantData($activity->type, ActivityTypes::All);
        $activityViewModel->topic             = (object) ['id' => $activity->topic->id, 'slug' => $activity->topic->slug];
        $activityViewModel->content           = self::getActivityContent($activity->content);
        return $activityViewModel;
    }

    private static function getActivityContent($content)
    {
        if(!$content)
            return null;
        if($content instanceof ScormModel){
            $service = new ScormService(new ScormTrackService());
            $uuid = $content->sco->uuid;
            return $service->getScoViewDataByUuid($uuid);
        }
        return ($content instanceof Wysiwig)? WysiwigViewModel::getSingleWysiwigViewModel($content) : (($content instanceof Resource)? ResourceViewModel::getSingleResourceViewModel($content) : QuizViewModel::getSingleQuizViewModel($content));
    }
}
