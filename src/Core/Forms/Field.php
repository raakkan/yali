<?php

namespace Raakkan\Yali\Core\Forms;

use Illuminate\Support\Str;
use Illuminate\Contracts\Validation\Rule;
use Raakkan\Yali\Core\Forms\Traits\HasValidation;

abstract class Field
{
    use HasValidation;

    public $name;

    public $label;

    public $default;

    public $placeholder;

    protected $type = '';

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
        return $this->label ?? Str::of($this->name)->replace('_', ' ')->title();
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

    public function placeholder($placeholder)
    {
        $this->placeholder = $placeholder;
        return $this;
    }

    public function getPlaceholder()
    {
        $placeholder = $this->placeholder;

        if (empty($placeholder)) {
            $placeholder = isset($this->label) ?? 'Enter ' . Str::of($this->label)->replace('_', ' ')->title();
        }

        if (empty($placeholder)) {
            $placeholder = 'Enter ' . Str::of($this->name)->replace('_', ' ')->title();
        }

        if (empty($placeholder)) {
            $placeholder = '';
        }

        return $placeholder;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }
}
