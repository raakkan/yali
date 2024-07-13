<?php

namespace Raakkan\Yali\Core\Settings\Concerns;

trait HasSettingSource
{
    protected $source;

    public function getSource()
    {
        return $this->source;
    }

    public function setSource($source)
    {
        $this->source = $source;

        return $this;
    }

    public function hasSource($source)
    {
        return $this->source === $source;
    }

    public function isSource($source)
    {
        return $this->hasSource($source);
    }
}