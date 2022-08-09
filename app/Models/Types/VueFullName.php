<?php

namespace App\Models\Types;

use App\Http\Enums\VueTypeError;

/**
 * NAME type
 */
class VueFullName extends VueType
{
    /**
     * Validate
     *
     * @param $value
     *
     * @return string
     */
    public function validate($value): ?string
    {
        if ($value !== null) {
            if (3 > strlen($value) || strlen($value) > 255) {
                throw new \TypeError(VueTypeError::INVALID_NAME->text());
            }
        }

        return $value;
    }
}
