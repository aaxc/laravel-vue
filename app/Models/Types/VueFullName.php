<?php

namespace App\Models\Types;

use App\Enums\VueTypeError;

/**
 * FULL NAME type
 */
class VueFullName extends VueType
{
    /**
     * Validate
     *
     * @param $value
     *
     * @return string|null
     */
    public function validate($value): ?string
    {
        if ($value !== null) {
            if (2 > strlen($value) || strlen($value) > 255) {
                throw new \TypeError(VueTypeError::INVALID_NAME->text());
            }
        }

        return $value;
    }
}
