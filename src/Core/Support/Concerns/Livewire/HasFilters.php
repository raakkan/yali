<?php

namespace Raakkan\Yali\Core\Support\Concerns\Livewire;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Livewire\Attributes\Computed;

trait HasFilters
{
    public $filterInputs = [];

    public function updatedFilterInputs()
    {
        if (method_exists($this, 'resetPage')) {
            $this->resetPage();
        }
    }

    public function setFilterInputs()
    {
        $this->filterInputs = collect($this->getFilters())->mapWithKeys(function ($filter) {
            return [$filter->getName() => $filter->getValue()];
        })->toArray();
    }

    #[Computed]
    public function hasFilters()
    {
        foreach ($this->filterInputs as $value) {
            if (! empty($value)) {
                return true;
            }
        }

        return false;
    }

    public function clearAllFilters()
    {
        $this->setFilterInputs();

        if (method_exists($this, 'resetPage')) {
            $this->resetPage();
        }
    }

    #[Computed]
    public function getSort()
    {
        $filters = $this->getFilters();

        $data = [];
        foreach ($filters as $filter) {
            if (method_exists($filter, 'ascLabel')) {
                $data[$filter->getName()] = $this->filterInputs[$filter->getName()];
            }
        }

        return $data;
    }

    public function sortBy($column)
    {
        $filter = $this->getFilterByName($column);

        if ($filter && array_key_exists($column, $this->filterInputs)) {
            if ($this->filterInputs[$column]) {
                $this->filterInputs[$column] = $this->filterInputs[$column] === 'asc' ? 'desc' : 'asc';
            } else {
                $this->filterInputs[$column] = 'asc';
            }
        }

        if (method_exists($this, 'resetPage')) {
            $this->resetPage();
        }
    }

    public function applyFilters(Builder $query)
    {
        $filters = $this->getFilters();
        foreach ($filters as $filter) {
            foreach ($this->filterInputs as $name => $value) {
                if ($filter->getName() === $name) {
                    $filter->setValue($value);
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
    }
}
