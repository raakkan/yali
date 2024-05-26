<?php

namespace Raakkan\Yali\Core\Filters\Concerns;

trait HasFilters
{
    public $filters = [];

    public function filters($filters)
    {
        $this->filters = $filters;
        return $this;
    }

    public function getFilters()
    {
        return $this->filters;
    }

    public function getFilterByName($name)
    {
        foreach ($this->getFilters() as $filter) {
            if ($filter->getName() == $name) {
                return $filter;
            }
        }
        return null;
    }
}