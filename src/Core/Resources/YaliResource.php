<?php

namespace Raakkan\Yali\Core\Resources;

use Livewire\WithPagination;
use Raakkan\Yali\Core\Resources\Actions\CreateAction;
use Raakkan\Yali\Core\Resources\Actions\DeleteAction;
use Raakkan\Yali\Core\Resources\Actions\EditAction;
use Raakkan\Yali\Core\Support\Concerns\Livewire\HasFilters;
use Raakkan\Yali\Core\Support\Concerns\Livewire\HasPagination;
use Raakkan\Yali\Core\Support\Concerns\Livewire\HasRecords;
use Raakkan\Yali\Core\Support\Concerns\Livewire\HasSearch;
use Raakkan\Yali\Core\Table\YaliTable;

class YaliResource extends BaseResource
{
    use HasFilters;
    use HasPagination;
    use HasRecords;
    use HasSearch;
    use WithPagination;

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
        $table->setModel(static::getModel());

        return [
            'table' => $table,
            'records' => $records,
            'columns' => $table->getColumns(),
        ];
    }

    public static function getResourceTable(): YaliTable
    {
        $table = static::getTable();

        if (! $table->hasActions()) {
            $table = static::getResourceTableActions($table);
        }

        return $table;
    }

    public static function getResourceTableActions(YaliTable $table): YaliTable
    {
        foreach (static::getPages() as $key => $page) {
            if ($key == 'create') {
                $table->actions = array_merge($table->actions, [
                    CreateAction::make()->link($page::getRouteName()),
                ]);
            } elseif ($key == 'edit') {
                $table->actions = array_merge($table->actions, [
                    EditAction::make()->link($page::getRouteName()),
                ]);
            }
        }
        $table->actions = array_merge($table->actions, [
            DeleteAction::make(),
        ]);

        return $table;
    }

    public static function getFilters()
    {
        return static::getResourceTable()->getFilters();
    }

    public static function getFilterByName($name)
    {
        return static::getResourceTable()->getFilterByName($name);
    }

    public static function getPages()
    {
        return [];
    }

    public static function getAction($actionClass, $modelKey)
    {
        return static::getResourceTable()->getAction($actionClass);
    }
}
