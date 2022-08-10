<?php

namespace App\Models\Types;

/**
 * PASSWORD type
 *
 * @author Dainis Abols <dainis@dainisabols.lv>
 */
class VuePassword extends VueType
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
        return $value;
    }
}
