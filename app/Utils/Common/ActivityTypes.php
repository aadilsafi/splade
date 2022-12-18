<?php

namespace App\Utils\Common;

class ActivityTypes
{
    const WYSIWIG      = 1;
    const RESOURCE     = 2;
    const QUIZ         = 3;
    const SCORM        = 4;
    const ATTEMPT      = 5;

    const All = [
        self::WYSIWIG      => 'Wysiwig',
        self::RESOURCE     => 'Resource',
        self::QUIZ         => 'Quiz',
        self::SCORM        => 'Scorm',
        self::ATTEMPT      => 'Attempt'

    ];
}
