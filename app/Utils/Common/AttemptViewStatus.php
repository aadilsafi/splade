<?php

namespace App\Utils\Common;

class AttemptViewStatus
{
    const PASS      = 1;
    const FAIL     = 2;

    const All = [
        self::PASS      => 'Pass',
        self::FAIL     => 'Fail',
    ];
}
