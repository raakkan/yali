<?php

namespace Raakkan\Yali\Core\Table\Concerns;

trait HasColumns
{
    public $columns = [];

    public function getSortableColumns()
    {
        return collect($this->columns)->filter(function ($column) {
            return $column->sortable;
        })->toArray();
    }

    public function columns($columns)
    {
        $this->columns = $columns;
        return $this;
    }

    public function getColumns()
    {
        return $this->columns;
    }

    public function getSearchableColumns()
    {
        return collect($this->columns)->filter(function ($column) {
            return $column->searchable;
        })->map(function ($column) {
            return $column->getName();
        })->toArray();
    }

    public function isAnyColumnSearchable()
    {
        return collect($this->columns)->contains(function ($column) {
            return $column->isSearchable();
        });
    }
}