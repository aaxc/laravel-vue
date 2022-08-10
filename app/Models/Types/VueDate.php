<?php

namespace App\Models\Types;

use App\Enums\VueTypeError;
use Illuminate\Support\Carbon;
use JetBrains\PhpStorm\ArrayShape;

/**
 * DATE type
 *
 * @author Dainis Abols <dainis@dainisabols.lv>
 */
class VueDate extends VueType
{
    /**
     * Validate
     *
     * @param $value
     *
     * @return \Illuminate\Support\Carbon|null
     */
    public function validate($value): ?Carbon
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
    #[ArrayShape(['toEdit' => "bool", 'value' => "mixed"])]
    public function jsonSerialize(): array
    {
        return [
            'toEdit' => $this->toEdit,
            'value'  => $this->value->format("Y-m-d H:i:s"),
        ];
    }
}
