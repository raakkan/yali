<?php

namespace Raakkan\Yali\Core\Support\Concerns;


trait HasMargin
{
    public $margin = 0;

    public $noMargin = false;

    public function margin($margin = 0)
    {
        $this->margin = $margin;
        return $this;
    }

    public function getMargin()
    {
        return $this->margin;
    }

    public function getMarginStyle()
    {
        return "margin: {$this->margin}px;";
    }

    public function getMarginClass()
    {
        return "m-{$this->margin}";
    }

    public function hasMargin()
    {
        return !$this->noMargin && $this->margin > 0;
    }

    public function noMargin()
    {
        $this->noMargin = true;
        return $this;
    }
}