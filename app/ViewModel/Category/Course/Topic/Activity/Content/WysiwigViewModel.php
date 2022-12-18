<?php


namespace App\ViewModel\Category\Course\Topic\Activity\Content;


class WysiwigViewModel
{
    public $id;
    public $body;

    public static function getSingleWysiwigViewModel($wysiwig)
    {
        $wysiwigViewModel       = new WysiwigViewModel();
        $wysiwigViewModel->id   = $wysiwig->id;
        $wysiwigViewModel->body = $wysiwig->body;
        return $wysiwigViewModel;
    }
}
