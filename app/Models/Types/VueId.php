<?php

namespace App\Models\Types;

use App\Enums\VueTypeError;

/**
 * ID type
 *
 * @author Dainis Abols <dainis@dainisabols.lv>
 */
class VueId extends VueType
{
    /**
     * Validate
     *
     * @param $value
     *
     * @return int|null
     */
    public function validate($value): ?int
    {
        if ($value !== null) {
            if (!is_int($value) || $value <= 0) {
                throw new \TypeError(VueTypeError::INVALID_ID->text());
            }
        }

        return $value;
    }
}
