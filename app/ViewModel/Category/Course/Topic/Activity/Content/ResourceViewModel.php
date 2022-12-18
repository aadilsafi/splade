<?php


namespace App\ViewModel\Category\Course\Topic\Activity\Content;


use App\Utils\Common\ResourceTypes;
use App\Utils\Helper;

class ResourceViewModel
{
    public $id;
    public $type;
    public $file_size;
    public $mime_type;
    public $path;
    public $settings;

    public static function getSingleResourceViewModel($resource)
    {
        $resourceViewModel              = new ResourceViewModel();
        $resourceViewModel->id          = $resource->id;
        $resourceViewModel->type        = Helper::getConstantData($resource->type, ResourceTypes::All);
        $resourceViewModel->path        = asset($resource->path);
        $resourceViewModel->file_size   = $resource->file_size;
        $resourceViewModel->mime_type   = $resource->mime_type;
        $resourceViewModel->settings    = $resource->settings;
        return $resourceViewModel;
    }
}
