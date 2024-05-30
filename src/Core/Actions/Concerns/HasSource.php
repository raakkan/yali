<?php

namespace Raakkan\Yali\Core\Actions\Concerns;

use Raakkan\Yali\Core\Pages\YaliPage;
use Raakkan\Yali\Core\Resources\YaliResource;

trait HasSource
{
    protected YaliResource | YaliPage $source;

    public function getSource()
    {
        return $this->source;
    }

    public function setSource(YaliResource | YaliPage $source)
    {
        $this->source = $source;
        return $this;
    }

    public function getSourceClass()
    {
        return $this->getSource()->getClass();
    }
}
