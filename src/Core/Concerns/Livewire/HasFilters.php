<?php

namespace Raakkan\Yali\Core\Concerns\Livewire;

use Livewire\Attributes\Computed;
use Illuminate\Contracts\Database\Eloquent\Builder;

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
            if (!empty($value)) {
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
