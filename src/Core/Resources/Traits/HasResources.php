<?php

namespace Raakkan\Yali\Core\Resources\Traits;

trait HasResources
{
    protected $resources = [];

    public function addResource($resource)
    {
        $this->resources[] = $resource;
    }

    public function getResources()
    {
        return $this->resources;
    }
}
