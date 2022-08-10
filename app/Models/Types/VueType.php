<?php

namespace App\Models\Types;

use App\Interfaces\VueTypeInterface;
use JetBrains\PhpStorm\ArrayShape;

/**
 * Vue type for user settings
 *
 * @author Dainis Abols <dainis@dainisabols.lv>
 */
abstract class VueType implements VueTypeInterface, \JsonSerializable
{
    /**
     * Edit setting
     *
     * @var bool
     */
    protected bool $toEdit = false;

    /**
     * Main value
     */
    protected $value;

    /**
     * Get edit settings
     *
     * @return bool
     */
    public function isToEdit(): bool
    {
        return $this->toEdit;

    }

    /**
     * Set edit settings
     *
     * @param bool $toEdit
     *
     * @return \App\Interfaces\VueTypeInterface
     */
    public function setToEdit(bool $toEdit): VueTypeInterface
    {
        $this->toEdit = $toEdit;

        return $this;
    }

    /**
     * Return value
     *
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * Create and validate value
     *
     * @param $value
     */
    public function __construct($value)
    {
        $this->value = $this->validate($value);
    }

    /**
     * To JSON
     *
     * @return array
     */
    #[ArrayShape(['toEdit' => "bool", 'value' => ""])]
    public function jsonSerialize(): array
    {
        return [
            'toEdit' => $this->toEdit,
            'value'  => $this->value,
        ];
    }
}
