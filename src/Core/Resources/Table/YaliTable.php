<?php

namespace Raakkan\Yali\Core\Resources\Table;

use Illuminate\Database\Eloquent\Model;
use Raakkan\Yali\Core\Resources\YaliResource;

class YaliTable
{
    public $resource;
    public $columns = [];

    protected $pagination = 10;

    public $includeDeleted = false;

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

    public function getResourceModel(): Model
    {
        return $this->resource->getModelInstance();
    }

    public function getResourceModelData()
    {
        return $this->getResourceModel()->all();
    }

    public function getResourceModelQuery()
    {
        return $this->getResourceModel()->query();
    }

    public function getResourceName(): string
    {
        return $this->resource->getName();
    }

    public function getResourceTitle(): string
    {
        return $this->resource->getTitle();
    }

    public function pagination($pagination)
    {
        $this->pagination = $pagination;
        return $this;
    }

    public function getPagination()
    {
        return $this->pagination;
    }

    public function getSearchableColumns()
    {
        return collect($this->columns)->filter(function ($column) {
            return $column->searchable;
        })->map(function ($column) {
            return $column->getName();
        })->toArray();
    }

    public function getSortedQuery($query)
    {
        foreach ($this->columns as $column) {
            if ($column->sortable && $column->sortDirection) {
                $query->orderBy($column->getName(), $column->sortDirection);
            }
        }

        return $query;
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
        $model = $this->getResourceModel();

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

}
