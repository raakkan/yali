<?php

namespace Raakkan\Yali\Core\Concerns\UI;

trait Layoutable
{
    protected $maxWidth;
    protected $gridColumns;
    protected $gap;

    public function getMaxWidth()
    {
        return $this->maxWidth ?: 'max-w-md';
    }

    public function maxWidth($value)
    {
        if ($value instanceof \BackedEnum) {
            $this->maxWidth = $value->value;
        }else {
            $this->maxWidth = $value;
        }
        
        return $this;
    }

    public function getGridColumns()
    {
        return $this->gridColumns;
    }

    public function gridColumns($value)
    {
        if ($value instanceof \BackedEnum) {
            $this->gridColumns = $value->value;
        }else {
            $this->gridColumns = $value;
        }

        return $this;
    }

    public function getGap()
    {
        return $this->gap ?: 4;
    }

    public function gap($value)
    {
        if ($value instanceof \BackedEnum) {
            $this->gap = $value->value;
        }else {
            $this->gap = $value;
        }
        
        return $this;
    }
}
