<?php

namespace Raakkan\Yali\Core\Table\Concerns;

use Raakkan\Yali\Core\Filters\SortFilter;

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
        $sortableColumns = $this->getSortableColumns();
        
        foreach ($sortableColumns as $column) {
            $this->filters = array_merge($this->filters, [SortFilter::make($column->getName())->setValue($column->getSortDirection())->hidden()]);
        }
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