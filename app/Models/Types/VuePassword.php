<?php

namespace App\Models\Types;

/**
 * PASSWORD type
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

    /**
     * Change date format for JSON output
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'toEdit' => $this->toEdit,
            'value'  => $this->value,
        ];
    }
}
