<?php

namespace Raakkan\Yali\Core\Support\Concerns\UI;

trait Borderable
{
    /**
     * The border width of the object.
     *
     * @var string
     */
    protected $borderWidth;

    /**
     * The border style of the object.
     *
     * @var string
     */
    protected $borderStyle;

    /**
     * The border color of the object.
     *
     * @var string
     */
    protected $borderColor;

    /**
     * The border radius of the object.
     *
     * @var string
     */
    protected $rounded;

    /**
     * Get the border width of the object.
     *
     * @return string
     */
    public function getBorderWidth()
    {
        return $this->borderWidth ?? 'border';
    }

    /**
     * Set the border width of the object using Tailwind classes.
     *
     * @param  string  $width
     * @return $this
     */
    public function borderWidth($width)
    {
        $this->borderWidth = 'border-' . $width;

        return $this;
    }

    /**
     * Get the border style of the object.
     *
     * @return string
     */
    public function getBorderStyle()
    {
        return $this->borderStyle ?? 'border-solid';
    }

    /**
     * Set the border style of the object using Tailwind classes.
     *
     * @param  string  $style
     * @return $this
     */
    public function borderStyle($style)
    {
        $this->borderStyle = 'border-' . $style;

        return $this;
    }

    /**
     * Get the border color of the object.
     *
     * @return string
     */
    public function getBorderColor()
    {
        return $this->borderColor ?? 'border-gray-300';
    }

    /**
     * Set the border color of the object using Tailwind classes.
     *
     * @param  string  $color
     * @return $this
     */
    public function borderColor($color)
    {
        if ($color instanceof \BackedEnum) {
            $this->borderColor = 'border-' . $color->value;
        } else {
            $this->borderColor = 'border-' . $color;
        }

        return $this;
    }

    /**
     * Get the border radius of the object.
     *
     * @return string
     */
    public function getRounded()
    {
        return $this->rounded ?: 'rounded';
    }

    /**
     * Set the border radius of the object using Tailwind classes.
     *
     * @param  string  $radius
     * @return $this
     */
    public function rounded($radius = null)
    {
        if ($radius !== null) {
            if ($radius instanceof \BackedEnum) {
                $this->rounded = $radius->value;
            } elseif (str_contains($radius, 'rounded')) {
                $this->rounded = $radius;
            } else {
                $this->rounded = 'rounded-' . $radius;
            }
        } else {
            $this->rounded = null;
        }

        return $this;
    }

    /**
     * Determine if the object has a border width.
     *
     * @return bool
     */
    public function hasBorderWidth()
    {
        return !empty($this->borderWidth);
    }

    /**
     * Determine if the object has a border style.
     *
     * @return bool
     */
    public function hasBorderStyle()
    {
        return !empty($this->borderStyle);
    }

    /**
     * Determine if the object has a border color.
     *
     * @return bool
     */
    public function hasBorderColor()
    {
        return !empty($this->borderColor);
    }

    /**
     * Determine if the object has a border radius.
     *
     * @return bool
     */
    public function hasRounded()
    {
        return !empty($this->rounded);
    }

    /**
     * Remove the border width from the object.
     *
     * @return $this
     */
    public function removeBorderWidth()
    {
        $this->borderWidth = null;

        return $this;
    }

    /**
     * Remove the border style from the object.
     *
     * @return $this
     */
    public function removeBorderStyle()
    {
        $this->borderStyle = null;

        return $this;
    }

    /**
     * Remove the border color from the object.
     *
     * @return $this
     */
    public function removeBorderColor()
    {
        $this->borderColor = null;

        return $this;
    }

    /**
     * Remove the border radius from the object.
     *
     * @return $this
     */
    public function removeRounded()
    {
        $this->rounded = null;

        return $this;
    }
}
