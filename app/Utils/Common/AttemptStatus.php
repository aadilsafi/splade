<?php

namespace App\Utils\Common;

class AttemptStatus
{
    const PENDING      = 1;
    const ATTEMPTED     = 2;

    const All = [
        self::PENDING      => 'Pending',
        self::ATTEMPTED     => 'Attempted',
    ];
}
