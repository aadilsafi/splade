<?php


namespace App\Utils\Common;


class CourseStatus
{
    const DRAFT = 1;
    const PUBLISHED = 2;

    const ALL = [
        self::DRAFT => "Draft",
        self::PUBLISHED => "Published",
    ];
}
