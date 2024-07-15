<?php

namespace Raakkan\Yali\Core\Support\Concerns;

trait HasPlaceholder
{
    protected $placeholder;

    public function placeholder($placeholder)
    {
        $this->placeholder = $placeholder;

        return $this;
    }

    public function getPlaceholder()
    {
        return $this->placeholder;
    }

    public function hasPlaceholder()
    {
        return ! empty($this->placeholder);
    }

    public function setPlaceholder($placeholder)
    {
        $this->placeholder = $placeholder;

        return $this;
    }
}
