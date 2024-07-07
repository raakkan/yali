<?php

namespace Raakkan\Yali\Core\Support\Concerns;

trait HasLabel
{
    protected $label;

    public function getLabel()
    {
        return $this->label;
    }

    public function label($label)
    {
        $this->label = $label;
        return $this;
    }

    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }

    public function hasLabel()
    {
        return !empty($this->label);
    }
}