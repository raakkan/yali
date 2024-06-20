<?php

namespace Raakkan\Yali\Core\View;

use Raakkan\Yali\Core\Concerns\Makable;
use Raakkan\Yali\Core\Concerns\UI\Stylable;

abstract class BaseComponent
{
    use Makable;
    use Stylable;
    
    protected $label;
    protected $icon;
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

    public function setIcon($icon)
    {
        $this->icon = $icon;
        return $this;
    }

    public function icon($icon)
    {
        $this->icon = $icon;
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
