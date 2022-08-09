<?php

namespace App\Models\Types;

use App\Http\Enums\VueTypeError;

/**
 * ID type
 */
class VueId extends VueType
{
    /**
     * Validate
     *
     * @param $value
     *
     * @return int
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
