<?php

namespace Raakkan\Yali\Core\Concerns\Livewire;

trait HasResource
{
    public $resource;

    public function getResource()
    {
        $resource = $this->resource['class'];
        return new $resource();
    }

    public function getTable()
    {
        return $this->getResource()->table($this->getResource()->getTable());
    }

    public function getModel()
    {
        return $this->getResource()->getModelInstance();
    }

    public function getFilters()
    {
        return $this->getTable()->getFilters();
    }

    public function getQueryBuilder()
    {
        return $this->getResource()->getQueryBuilder();
    }

    public function getModelData()
    {
        $table = $this->getTable();

        $queryBuilder = $this->getQueryBuilder();

        $queryBuilder->search($this->search)
                    ->withTrashed()
                    ->applyFilters($table->getFilters(), $this->filterInputs);

        return $queryBuilder->paginate($table->getPerPage());
    }
}
