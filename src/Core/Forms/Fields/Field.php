<?php

namespace Raakkan\Yali\Core\Forms\Fields;

use Illuminate\Support\Str;
use Illuminate\Contracts\Validation\Rule;
use Raakkan\Yali\Core\View\YaliComponent;
use Raakkan\Yali\Core\Concerns\UI\Stylable;
use Raakkan\Yali\Core\Forms\Concerns\HasValidation;

abstract class Field extends YaliComponent
{
    use HasValidation;
    use Stylable;

    public $name;

    public $label;

    public $default;

    public $placeholder;

    protected $type = '';

    public $infoMessage;
    public $disableLabel = false;

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
        if($this->disableLabel) {
            return '';
        }
        
        return $this->label ?? Str::of($this->name)->replace('_', ' ')->title();
    }

    public function disableLabel()
    {
        $this->disableLabel = true;
        return $this;
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

    public function infoMessage($message)
    {
        $this->infoMessage = $message;
        return $this;
    }

    public function getInfoMessage()
    {
        return $this->infoMessage;
    }
}
