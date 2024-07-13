<?php

namespace Raakkan\Yali\Core\Table;

use Raakkan\Yali\Core\Filters\SortFilter;
use Raakkan\Yali\Core\View\YaliComponent;
use Raakkan\Yali\Core\Support\Concerns\Makable;
use Raakkan\Yali\Core\Table\Concerns\HasColumns;
use Raakkan\Yali\Core\Actions\Concerns\HasSource;
use Raakkan\Yali\Core\Actions\Concerns\HasActions;
use Raakkan\Yali\Core\Filters\Concerns\HasFilters;
use Raakkan\Yali\Core\Table\Concerns\HasModelRecords;
use Raakkan\Yali\Core\Support\Concerns\Database\HasModel;

class YaliTable extends YaliComponent
{
    use Makable;
    use HasFilters;
    use HasActions;
    use HasColumns;
    use HasModelRecords;
    use HasModel;
    use HasSource;

    protected $componentName = 'table';

    protected $view = 'yali::table.yali-table';

    protected $perPage = 10;

    public $includeDeleted = false;

    protected $responsiveConfig = [
        'enabled' => true,
        'maxWidth' => 640,
    ];

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

    public function enableResponsive(int $maxWidth = 640)
    {
        $this->responsiveConfig = [
            'enabled' => true,
            'maxWidth' => $maxWidth,
        ];
        return $this;
    }

    public function disableResponsive()
    {
        $this->responsiveConfig = [
            'enabled' => false,
        ];
        return $this;
    }

    public function getResponsiveConfig()
    {
        return $this->responsiveConfig;
    }

}
