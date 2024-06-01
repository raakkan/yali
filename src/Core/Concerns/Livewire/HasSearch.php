<?php

namespace Raakkan\Yali\Core\Concerns\Livewire;

use Illuminate\Contracts\Database\Eloquent\Builder;

trait HasSearch
{
    public $search = '';

    public $searchColumns = [];

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function clearSearch()
    {
        $this->search = '';
        $this->resetPage();
    }

    public function applySearch(Builder $query)
    {
        $columns = $this->searchColumns;
        $search = $this->search;
        
        if (!empty($this->search) && !empty($columns)) {
            if (!empty($columns)) {
                $query->where(function ($q) use ($columns, $search) {
                    foreach ($columns as $column) {
                        $q->orWhere($column, 'like', '%' . $search . '%');
                    }
                });
            }
        }

        return $query;
    }

    public function setSearchColumns($columns)
    {
        $this->searchColumns = $columns;
    }
}
