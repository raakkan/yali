<?php

namespace Raakkan\Yali\Core\View\Components;

use Illuminate\Support\Traits\Macroable;
use Raakkan\Yali\Core\Support\Concerns\Makable;
use Raakkan\Yali\Core\Support\Concerns\UI\Stylable;

abstract class BaseComponent
{
    use Macroable;
    use Makable;
    use Stylable;

    protected $label;

    protected $attributes = [];

    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    public function label($label)
    {
        $this->label = $label;

        return $this;
    }

    public function setAttributes(array $attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }

    public function attributes(array $attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }

    public function getAttributes()
    {
        return $this->attributes;
    }

    public function withAttributes(array $attributes)
    {
        $this->attributes = array_merge($this->attributes, $attributes);

        return $this;
    }

    public function hasLabel()
    {
        return isset($this->label);
    }

    abstract public function render();

    public function __toString()
    {
        return $this->render();
    }
}
