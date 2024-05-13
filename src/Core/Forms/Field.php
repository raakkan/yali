<?php

namespace Raakkan\Yali\Core\Forms;

use Illuminate\Contracts\Validation\Rule;
use Raakkan\Yali\Core\Forms\Traits\HasValidation;

abstract class Field
{
    use HasValidation;
    /**
     * The name of the field.
     *
     * @var string
     */
    public $name;

    /**
     * The label of the field.
     *
     * @var string
     */
    public $label;

    public $default;

    public static function make($name)
    {
        return new static($name);
    }

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function label($label)
    {
        $this->label = $label;
        return $this;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function default($default)
    {
        $this->default = $default;
        return $this;
    }

    public function getDefault()
    {
        return $this->default;
    }

    public function getName()
    {
        return $this->name;
    }
}
