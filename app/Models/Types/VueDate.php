<?php

namespace App\Models\Types;

use App\Http\Enums\VueTypeError;
use Illuminate\Support\Carbon;

/**
 * NAME type
 */
class VueDate extends VueType
{
    /**
     * Validate
     *
     * @param $value
     *
     * @return string
     */
    public function validate($value): Carbon
    {
        if ($value::class !== Carbon::class) {
            if (date('Y-m-d', strtotime($value)) !== $value) {
                throw new \TypeError(VueTypeError::INVALID_DATE->text());
            }

            $value = new Carbon($value);
        }

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
            'value'  => $this->value->format("Y-m-d H:i:s"),
        ];
    }
}
