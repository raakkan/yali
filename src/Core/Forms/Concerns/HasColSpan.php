<?php

namespace Raakkan\Yali\Core\Forms\Concerns;

trait HasColSpan
{
    protected $colSpan = 1; // Default span

    public function colSpan($span)
    {
        if (!$this->isValidColSpan($span)) {
            throw new \InvalidArgumentException("Invalid col span value: {$span}. It should be between 1 and 12.");
        }

        $this->colSpan = $span;
        return $this;
    }

    protected function isValidColSpan($span)
    {
        return is_int($span) && $span >= 1 && $span <= 12;
    }

    public function getColSpan()
    {
        return $this->colSpan;
    }
}
