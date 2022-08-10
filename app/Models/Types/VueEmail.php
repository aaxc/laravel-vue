<?php

namespace App\Models\Types;

use App\Enums\VueTypeError;

/**
 * EMAIL type
 */
class VueEmail extends VueType
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
            if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                throw new \TypeError(VueTypeError::INVALID_EMAIL->text());
            }
        }

        return $value;
    }
}
