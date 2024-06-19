<?php

namespace Raakkan\Yali\Core\Concerns\UI;

trait Colorable
{
    /**
     * The text color of the object.
     *
     * @var string
     */
    protected $textColor;

    /**
     * The background color of the object.
     *
     * @var string
     */
    protected $backgroundColor;

    /**
     * Get the text color of the object.
     *
     * @return string
     */
    public function getTextColor()
    {
        return $this->textColor ?? '';
    }

    /**
     * Set the text color of the object.
     *
     * @param  string  $color
     * @return $this
     */
    public function textColor($color)
    {
        if ($color instanceof \BackedEnum) {
            $this->textColor = $color->value;
        }else {
            $this->textColor = $color;
        }

        return $this;
    }

    /**
     * Get the background color of the object.
     *
     * @return string
     */
    public function getColor()
    {
        return $this->backgroundColor ?? '';
    }

    /**
     * Set the background color of the object.
     *
     * @param  string  $color
     * @return $this
     */
    public function color($color)
    {
        if ($color instanceof \BackedEnum) {
            $this->backgroundColor = $color->value;
        }else {
            $this->backgroundColor = $color;
        }

        return $this;
    }

    /**
     * Determine if the object has a text color.
     *
     * @return bool
     */
    public function hasTextColor()
    {
        return !empty($this->textColor);
    }

    /**
     * Determine if the object has a background color.
     *
     * @return bool
     */
    public function hasBackgroundColor()
    {
        return !empty($this->backgroundColor);
    }

    /**
     * Remove the text color from the object.
     *
     * @return $this
     */
    public function removeTextColor()
    {
        $this->textColor = null;

        return $this;
    }

    /**
     * Remove the background color from the object.
     *
     * @return $this
     */
    public function removeBackgroundColor()
    {
        $this->backgroundColor = null;

        return $this;
    }
}
