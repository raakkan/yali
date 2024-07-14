<?php

namespace Raakkan\Yali\Core\Forms\Concerns;


trait HasFieldValue
{
    public $value;
    public $oldValue;
    
    public $defaultValue;

    public function value($value)
    {
        $this->value = $value;
        return $this;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    public function hasValue()
    {
        return !is_null($this->value);
    }

    public function setOldValue($value)
    {
        $this->oldValue = $value;
        return $this;
    }

    public function getOldValue()
    {
        return $this->oldValue;
    }

    public function hasOldValue()
    {
        return !is_null($this->oldValue);
    }

    public function default($default)
    {
        $this->defaultValue = $default;
        return $this;
    }

    public function getDefault()
    {
        return $this->defaultValue;
    }
}