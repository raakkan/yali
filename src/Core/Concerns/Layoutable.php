<?php

namespace Raakkan\Yali\Core\Concerns;

trait Layoutable
{
    protected $maxWidth;
    protected $gridColumns;
    protected $gap;

    public function getMaxWidth()
    {
        return $this->maxWidth;
    }

    public function maxWidth($value)
    {
        $this->maxWidth = $value;
        return $this;
    }

    public function getGridColumns()
    {
        return $this->gridColumns;
    }

    public function gridColumns($value)
    {
        $this->gridColumns = $value;
        return $this;
    }

    public function getGap()
    {
        return $this->gap ?: 4;
    }

    public function gap($value)
    {
        $this->gap = $value;
        return $this;
    }
}
