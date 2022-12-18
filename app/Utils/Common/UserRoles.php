<?php


namespace App\Utils\Common;


class UserRoles
{
    const SUPER_ADMIN   = 1;
    const ADMIN         = 2;
    const AUTH_USER     = 3;
    const TRANIEE       = 4;
    const TRAINER       = 5;

    const ALL = [
        self::SUPER_ADMIN   => "Super Admin",
        self::ADMIN         => "Admin",
        self::AUTH_USER     => "Auth User",
        self::TRANIEE       => "Trainee",
        self::TRAINER       => "Trainer"
    ];
}
