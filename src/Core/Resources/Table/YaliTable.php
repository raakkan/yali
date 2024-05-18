<?php

namespace Raakkan\Yali\Core\Resources\Table;

use Illuminate\Database\Eloquent\Model;
use Raakkan\Yali\Core\Resources\YaliResource;

class YaliTable
{
    public $resource;
    public $columns = [];

    protected $perPage = 10;

    public $includeDeleted = false;

    public $filters = [];

    public $actions = [];

    public function __construct(YaliResource $resource)
    {
        $this->resource = $resource;
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

    public function perPage($perPage)
    {
        $this->perPage = $perPage;
        return $this;
    }

    public function getPerPage()
    {
        return $this->perPage;
    }

    public function getSearchableColumns()
    {
        return collect($this->columns)->filter(function ($column) {
            return $column->searchable;
        })->map(function ($column) {
            return $column->getName();
        })->toArray();
    }

    public function getDefaultSortableColumn()
    {
        $sortableColumns = array_filter(
            array_map(function ($column) {
                if ($column instanceof TableColumn && $column->isSortable()) {
                    return $column;
                }
                return null;
            }, $this->columns)
        );

        if (!empty($sortableColumns)) {
            return array_values($sortableColumns)[0];
        }

        return null;
    }

    public function isAnyColumnSearchable()
    {
        return collect($this->columns)->contains(function ($column) {
            return $column->isSearchable();
        });
    }

    public function enableSoftDeletes()
    {
        $model = $this->resource->getModelInstance();

        if (in_array('Illuminate\Database\Eloquent\SoftDeletes', class_uses_recursive($model))) {
            $this->includeDeleted = true;
        } else {
            throw new \Exception("The model {$this->resource->getModelName()} does not use the SoftDeletes trait.");
        }

        return $this;
    }

    public function isSoftDeletesEnabled(): bool
    {
        return $this->includeDeleted;
    }

    public function filters($filters)
    {
        $this->filters = $filters;
        return $this;
    }

    public function getFilters()
    {
        return $this->filters;
    }

    public function actions($actions)
    {
        $this->actions = $actions;
        return $this;
    }

    public function getActions()
    {
        return $this->actions;
    }

}
