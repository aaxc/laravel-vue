<?php

namespace App\Models\Types;

use App\Enums\VueTypeError;
use App\Rules\FullNameRule;

/**
 * FULL NAME type
 *
 * @author Dainis Abols <dainis@dainisabols.lv>
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
            if (!(new FullNameRule())->passes('full_name', $value)) {
                throw new \TypeError(VueTypeError::INVALID_NAME->text());
            }
        }

        return $value;
    }
}
