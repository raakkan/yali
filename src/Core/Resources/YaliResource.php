<?php

namespace Raakkan\Yali\Core\Resources;

use Raakkan\Yali\Core\Table\YaliTable;
use Raakkan\Yali\Core\Concerns\Livewire\HasFilters;
use Raakkan\Yali\Core\Concerns\Livewire\HasRecords;
use Raakkan\Yali\Core\Resources\Actions\EditAction;
use Raakkan\Yali\Core\Resources\Actions\CreateAction;
use Raakkan\Yali\Core\Resources\Actions\DeleteAction;

class YaliResource extends BaseResource
{
    use HasRecords;
    use HasFilters;
    
    protected static $view = 'yali::pages.yali-resource-page';

    public function mount()
    {
        $this->setFilterInputs();
    }

    public function getViewData()
    {
        return [
            'table' => $this->getResourceTable(),
        ];
    }

    public function getResourceTable(): YaliTable
    {
        $table = $this->table($this->getTable());

        $table->setRecords($this->getRecords($this->getModelQuery()));

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
