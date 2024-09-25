<?php

namespace App\Enums;

enum Gender: string
{
    case MALE = 'Male';
    case FEMALE = 'Female';

    public function toString()
    {
        return match ($this)
        {
            self::MALE => self::MALE,
            self::FEMALE => self::FEMALE,
        };
    }

}
