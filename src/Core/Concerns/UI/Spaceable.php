<?php

namespace Raakkan\Yali\Core\Concerns\UI;

trait Spaceable
{
    /**
     * The margin of the object.
     *
     * @var string
     */
    protected $margin;

    /**
     * The padding of the object.
     *
     * @var string
     */
    protected $padding;

    /**
     * Get the margin of the object.
     *
     * @return string
     */
    public function getMargin()
    {
        return $this->margin ?? 'm-4';
    }

    /**
     * Set the margin of the object.
     *
     * @param  string  $margin
     * @return $this
     */
    public function margin($margin)
    {
       if ($margin instanceof \BackedEnum) {
            $this->margin = $margin->value;
        }else {
            $this->margin = $margin;
        }

        return $this;
    }

    /**
     * Get the padding of the object.
     *
     * @return string
     */
    public function getPadding()
    {
        return $this->padding ?? 'p-4';
    }

    /**
     * Set the padding of the object.
     *
     * @param  string  $padding
     * @return $this
     */
    public function padding($padding)
    {
        if ($padding instanceof \BackedEnum) {
            $this->padding = $padding->value;
        }else {
            $this->padding = $padding;
        }

        return $this;
    }

    /**
     * Determine if the object has a margin.
     *
     * @return bool
     */
    public function hasMargin()
    {
        return !empty($this->margin);
    }

    /**
     * Determine if the object has padding.
     *
     * @return bool
     */
    public function hasPadding()
    {
        return !empty($this->padding);
    }

    /**
     * Remove the margin from the object.
     *
     * @return $this
     */
    public function removeMargin()
    {
        $this->margin = null;

        return $this;
    }

    /**
     * Remove the padding from the object.
     *
     * @return $this
     */
    public function removePadding()
    {
        $this->padding = null;

        return $this;
    }
}
