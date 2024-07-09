<?php

namespace Raakkan\Yali\Core\Support\Concerns;

trait HasPadding
{
    public $padding = 0;
    public $noPadding = false;

    public function padding($padding = 0)
    {
        $this->padding = $padding;
        return $this;
    }

    public function getPadding()
    {
        return $this->padding;
    }

    public function getPaddingStyle()
    {
        return "padding: {$this->padding}px;";
    }

    public function getPaddingClass()
    {
        return "p-{$this->padding}";
    }

    public function hasPadding()
    {
        return !$this->noPadding && $this->padding > 0;
    }

    public function noPadding()
    {
        $this->noPadding = true;
        return $this;
    }
}