<?php


namespace App\Utils\Common;


class EnrollmentTypes
{
    const TRANIEE       = 1;
    const TRAINER       = 2;

    const ALL = [
        self::TRANIEE       => "Trainee",
        self::TRAINER       => "Trainer"
    ];
}
