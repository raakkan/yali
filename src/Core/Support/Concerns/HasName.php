<?php

namespace Raakkan\Yali\Core\Support\Concerns;

trait HasName
{
    protected $name;

    public function name($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function hasName()
    {
        return !empty($this->name);
    }
}