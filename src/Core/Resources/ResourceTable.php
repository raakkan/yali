<?php 

namespace Raakkan\Yali\Core\Resources;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Raakkan\Yali\Core\Facades\YaliManager;

// TODO: pagination page/2 in url bar refresh if filter activated no data
class ResourceTable extends Component
{
    use WithPagination;

    public $resource;

    public $search = '';

    public $filterInputs = [];

    public function mount($resource)
    {
        $this->resource = YaliManager::resolveResource($resource);

        $this->setFilterInputs();
    }

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

    public function sortBy($column)
    {
        $filter = $this->getTable()->getFilterByName($column);

        if ($filter && array_key_exists($column, $this->filterInputs)) {
            if ($this->filterInputs[$column]) {
                $this->filterInputs[$column] = $this->filterInputs[$column] === 'asc' ? 'desc' : 'asc';
            }else{
                $this->filterInputs[$column] = 'asc';
            }
        }
        
        $this->resetPage();
    }

    #[Computed]
    public function getSort()
    {
        $filters = $this->getTable()->getFilters();

        $data = [];
        foreach ($filters as $filter) {
            if (method_exists($filter, 'ascLabel')) {
                $data[$filter->getName()] = $this->filterInputs[$filter->getName()];
            }
        }

        return $data;
    }

    public function clearSearch()
    {
        $this->search = '';
        $this->resetPage();
    }

    public function delete($id)
    {
        $model = $this->getModel();
        $record = $model->find($id);

        if ($record) {
            $record->delete();
            $this->dispatch('toast', type: 'success', message: $this->getResource()->getModelName() . ' has been deleted.');
            $this->resetPage();
        }
    }

    public function updatedFilterInputs()
    {
        $this->resetPage();
    }

    public function setFilterInputs()
    {
        $this->filterInputs = collect($this->getTable()->getFilters())->mapWithKeys(function ($filter) {
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
        $this->resetPage();
    }

    public function render()
    {
        return view('yali::table.resource-table', [
            'columns' => $this->getTable()->getColumns(),
            'modelData' => $this->getModelData(),
            'filters' => $this->getTable()->getFilters(),
            'actions' => $this->getTable()->getActions(),
            'headerActions' => $this->getTable()->getHeaderActions(),
        ]);
    }
}
