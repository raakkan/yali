<?php

namespace Raakkan\Yali\Core\Resources;

use Livewire\WithPagination;
use Raakkan\Yali\Core\Table\YaliTable;
use Raakkan\Yali\Core\Concerns\Livewire\HasSearch;
use Raakkan\Yali\Core\Concerns\Livewire\HasFilters;
use Raakkan\Yali\Core\Concerns\Livewire\HasRecords;
use Raakkan\Yali\Core\Resources\Actions\EditAction;
use Raakkan\Yali\Core\Resources\Actions\CreateAction;
use Raakkan\Yali\Core\Resources\Actions\DeleteAction;
use Raakkan\Yali\Core\Concerns\Livewire\HasPagination;

class YaliResource extends BaseResource
{
    use WithPagination;
    use HasFilters;
    use HasSearch;
    use HasPagination;
    use HasRecords;
    
    protected static $view = 'yali::pages.yali-resource-page';

    public function mount()
    {
        $this->setFilterInputs();
    }

    public function getViewData()
    {
        $table = $this->getResourceTable();
        $records = $this->getRecords($this->getModelQuery());
        $table->setRecords($records);
        
        return [
            'table' => $table,
            'records'=> $records,
            'columns' => $table->getColumns(),
        ];
    }

    public function getResourceTable(): YaliTable
    {
        $table = $this->table($this->getTable());

        if (!$table->hasActions()) {
            $table = $this->getResourceTableActions($table);
        }

        return $table;
    }

    public function getResourceTableActions(YaliTable $table): YaliTable
    {
        $table->actions = [
            CreateAction::make()->setLink(),
            EditAction::make()->setLink(),
            DeleteAction::make(),
        ];
        return $table;
    }

    public function getFilters()
    {
        return $this->getResourceTable()->getFilters();
    }

    public function getFilterByName($name)
    {
        return $this->getResourceTable()->getFilterByName($name);
    }
}
