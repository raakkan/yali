<?php

namespace Raakkan\Yali\Core\Concerns\UI;

trait Colorable
{
    protected $textColor;

    protected $backgroundColor;

    public function getTextColor()
    {
        return $this->textColor ?? '';
    }

    public function textColor($color)
    {
        if ($color instanceof \BackedEnum) {
            $this->textColor = $color->value;
        }else {
            $this->textColor = $color;
        }

        return $this;
    }

    public function getColor()
    {
        return $this->backgroundColor ?? '';
    }

    public function color($color)
    {
        if ($color instanceof \BackedEnum) {
            $this->backgroundColor = $color->value;
        }else {
            $this->backgroundColor = $color;
        }

        return $this;
    }

    public function hasTextColor()
    {
        return !empty($this->textColor);
    }

    public function hasBackgroundColor()
    {
        return !empty($this->backgroundColor);
    }

    public function removeTextColor()
    {
        $this->textColor = null;

        return $this;
    }

    public function removeBackgroundColor()
    {
        $this->backgroundColor = null;

        return $this;
    }
}
