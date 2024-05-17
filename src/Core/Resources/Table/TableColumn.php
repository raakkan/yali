<?php

namespace Raakkan\Yali\Core\Resources\Table;

use Illuminate\Support\Str;
use Raakkan\Yali\Core\Traits\Makable;

abstract class TableColumn
{
    use Makable;
    public $name;

    public $label;

    public $searchable = false;

    public $sortable = false;

    public $sortDirection = null;

    protected $renderCallback;

    public $type;

    protected $limitLength = null;

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

    public function render(callable $callback)
    {
        $this->renderCallback = $callback;

        return $this;
    }

    public function hasCustomRender()
    {
        return $this->renderCallback !== null;
    }

    public function renderCell($data)
    {
        if ($this->hasCustomRender()) {
            return call_user_func($this->renderCallback, $data);
        }

        return $data[$this->getName()];
    }

    // is this format using apend and prepend removed and if render method overrided
    public function formatUsing(callable $callback)
    {
        $this->renderCallback = function ($data) use ($callback) {
            $text = $this->limitLength ? Str::limit($data[$this->getName()], $this->limitLength) : $data[$this->getName()];
            return $callback($text);
        };

        return $this;
    }

    public function limit($length)
    {
        $this->limitLength = $length;

        $this->renderCallback = function ($data) {
            return Str::limit($data[$this->getName()], $this->limitLength);
        };

        return $this;
    }
}
