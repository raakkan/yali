<?php

namespace Raakkan\Yali\Core\Table;

use Raakkan\Yali\Core\Filters\SortFilter;
use Raakkan\Yali\Core\Table\Concerns\HasModelRecords;
use Raakkan\Yali\Core\View\YaliComponent;
use Raakkan\Yali\Core\Table\Concerns\HasColumns;
use Raakkan\Yali\Core\Actions\Concerns\HasActions;
use Raakkan\Yali\Core\Filters\Concerns\HasFilters;

class YaliTable extends YaliComponent
{
    use HasFilters;
    use HasActions;
    use HasColumns;
    use HasModelRecords;

    protected $view = 'yali::table.yali-table';

    protected $perPage = 10;

    public $includeDeleted = false;

    public function perPage($perPage)
    {
        $this->perPage = $perPage;
        return $this;
    }

    public function getPerPage()
    {
        return $this->perPage;
    }

    // public function enableSoftDeletes()
    // {
    //     $model = $this->resource->getModelInstance();

    //     if (in_array('Illuminate\Database\Eloquent\SoftDeletes', class_uses_recursive($model))) {
    //         $this->includeDeleted = true;
    //     } else {
    //         throw new \Exception("The model {$this->resource->getModelName()} does not use the SoftDeletes trait.");
    //     }

    //     return $this;
    // }

    public function isSoftDeletesEnabled(): bool
    {
        return $this->includeDeleted;
    }

    public function getFilters()
    {
        $sortableColumns = $this->getSortableColumns();
        
        foreach ($sortableColumns as $column) {
            $this->filters = array_merge($this->filters, [SortFilter::make($column->getName())->setValue($column->getSortDirection())->hidden()]);
        }
        return $this->filters;
    }

}
