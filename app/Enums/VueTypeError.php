<?php

namespace App\Enums;

/**
 * VUE Type Errors
 *
 * @author Dainis Abols <dainis@dainisabols.lv>
 */
enum VueTypeError
{
    case INVALID_ID;
    case INVALID_NAME;
    case INVALID_EMAIL;
    case INVALID_DATE;

    /**
     * Return text values of enums
     *
     * @return string
     */
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
