<?php

namespace Raakkan\Yali\Core\Resources\Table;

use Illuminate\Support\Str;

class TableColumn
{
    public $name;

    public $label;

    public $searchable = false;

    public $sortable = false;

    public $sortDirection = null;

    public static function make($name)
    {
        return new static($name);
    }

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function label($label)
    {
        $this->label = $label;
        return $this;
    }

    public function getLabel()
    {
        return $this->label ?: Str::title(str_replace('_','', $this->name));
    }

    public function getName()
    {
        return $this->name;
    }

    public function searchable($searchable = true)
    {
        $this->searchable = $searchable;
        return $this;
    }

    public function sortable($direction = 'asc')
    {
        $this->sortDirection = $direction;
        $this->sortable = true;
        return $this;
    }

    public function isSortable()
    {
        return $this->sortable;
    }

    public function isSearchable()
    {
        return $this->searchable;
    }

    public function getSortDirection()
    {
        return $this->sortDirection;
    }
}
