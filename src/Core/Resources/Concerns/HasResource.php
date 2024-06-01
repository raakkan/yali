<?php

namespace Raakkan\Yali\Core\Resources\Concerns;

trait HasResource
{
    public $resource;

    public function getResource()
    {
        $resource = $this->resource['class'];
        return new $resource();
    }

    public function getTable()
    {
        return $this->getResource()->table($this->getResource()->getTable());
    }

    public function getModel()
    {
        return $this->getResource()->getModelInstance();
    }

    public function getFilters()
    {
        return $this->getTable()->getFilters();
    }

    public function getQuery()
    {
        return $this->getModel()->newQuery();
    }
}
