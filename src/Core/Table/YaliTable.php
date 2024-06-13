<?php

namespace Raakkan\Yali\Core\Table;

use Raakkan\Yali\Core\Concerns\Database\HasModel;
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
    use HasModel;

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

    public function getFilters()
    {
        $sortableColumns = $this->getSortableColumns();
        
        foreach ($sortableColumns as $column) {
            $this->filters = array_merge($this->filters, [SortFilter::make($column->getName())->setValue($column->getSortDirection())->hidden()]);
        }
        return $this->filters;
    }
}
