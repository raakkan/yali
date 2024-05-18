<?php

namespace Raakkan\Yali\Core\Resources;

use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Builder;
use Raakkan\Yali\Core\Resources\Table\YaliTable;

class ResourceQueryBuilder
{
    protected $query;
    protected $table;

    public function __construct(Builder $query, YaliTable $table)
    {
        $this->query = $query;
        $this->table = $table;
    }

    public function search($search)
    {
        if (!empty($search)) {
            $columns = $this->table->getSearchableColumns();
            if (!empty($columns)) {
                $this->query->where(function ($q) use ($columns, $search) {
                    foreach ($columns as $column) {
                        $q->orWhere($column, 'like', '%' . $search . '%');
                    }
                });
            }
        }

        return $this;
    }

    public function sort($column, $direction)
    {
        if (!empty($column)) {
            $this->query->orderBy($column, $direction);
        }

        return $this;
    }

    public function withTrashed()
    {
        if ($this->table->isSoftDeletesEnabled()) {
            $this->query->withTrashed();
        }

        return $this;
    }

    public function filter($filters)
    {
        foreach ($filters as $filter => $value) {
            if (method_exists($this, $filter)) {
                $this->$filter($value);
            } elseif ($this->table->getColumns()->contains($filter)) {
                $this->query->where($filter, $value);
            }
        }

        return $this;
    }

    public function paginate($perPage)
    {
        return $this->query->paginate($perPage);
    }

    public function get()
    {
        return $this->query->get();
    }

    public function getQuery()
    {
        return $this->query;
    }

    public function applyFilters($filters)
    {
        $this->query->where(function ($query) use ($filters) {
            foreach ($filters as $filter) {
                $query = $filter->handle($query, function ($query) {
                    return $query;
                });
            }
        });
    
        return $this;
    }
    
}
