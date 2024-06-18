<?php

namespace Raakkan\Yali\Core\Actions\Concerns;

trait HasSource
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
}
