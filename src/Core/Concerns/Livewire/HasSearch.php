<?php

namespace Raakkan\Yali\Core\Concerns\Livewire;

use Illuminate\Contracts\Database\Eloquent\Builder;

trait HasSearch
{
    public $search = '';

    public function updatedSearch()
    {
        if (method_exists($this, 'resetPage')) {
            $this->resetPage();
        }
    }

    public function clearSearch()
    {
        $this->search = '';
        if (method_exists($this, 'resetPage')) {
            $this->resetPage();
        }
    }

    public function applySearch(Builder $query)
    {
        $search = $this->search;
        
        if (property_exists($this,'table')) {
            $columns = $this->getTable()->getSearchableColumns();

            if (!empty($search) && !empty($columns)) {
                if (!empty($columns)) {
                    $query->where(function ($q) use ($columns, $search) {
                        foreach ($columns as $column) {
                            $q->orWhere($column, 'like', '%' . $search . '%');
                        }
                    });
                }
            }
        }

        return $query;
    }
}
