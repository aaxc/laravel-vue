<?php

namespace App\Http\Enums;

/**
 * VUE Type Errors
 */
enum VueTypeError
{
    case INVALID_ID;
    case INVALID_NAME;
    case INVALID_EMAIL;
    case INVALID_DATE;

    public function text(): string
    {
        return match ($this) {
            self::INVALID_ID => 'Invalid ID',
            self::INVALID_NAME => 'Invalid NAME',
            self::INVALID_EMAIL => 'Invalid EMAIL',
            self::INVALID_DATE => 'Invalid DATE',
        };
    }
}
