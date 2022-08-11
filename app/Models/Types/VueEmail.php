<?php

namespace App\Models\Types;

use App\Enums\VueTypeError;
use App\Rules\EmailRule;

/**
 * EMAIL type
 *
 * @author Dainis Abols <dainis@dainisabols.lv>
 */
class VueEmail extends VueType
{
    /**
     * Set field uneditable
     *
     * @var bool
     */
    protected bool $toEdit = false;

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
            if (!(new EmailRule())->passes('email', $value)) {
                throw new \TypeError(VueTypeError::INVALID_EMAIL->text());
            }
        }

        return $value;
    }
}
