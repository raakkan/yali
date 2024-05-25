<?php

namespace Raakkan\Yali\Core\Resources;

use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Builder;
use Raakkan\Yali\Core\Filters\SortFilter;
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

    public function paginate($perPage = 10)
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

    public function applyFilters($filters, $livewireData = [])
    {
        $this->query->where(function ($query) use ($filters, $livewireData, &$sortFilter) {
            foreach ($filters as $filter) {
                if (!empty($livewireData)) {
                    foreach ($livewireData as $name => $value) {
                        
                        // if ($filter instanceof SortFilter && method_exists($filter, 'ascLabel') && $value && $filter->getName() === $name) {
                        //     $this->sort($filter->getName(), $value);
                        //     continue;
                        // }

                        if ($filter->getName() === $name) {
                            $filter->setValue($value);
                        }
                    }
                }

                if ($filter->skip) {
                    continue;
                }

                $query = $filter->handle($query, function ($query) {
                    return $query;
                });
            }
            return $query;
        });

        return $this;
    }
    
}
