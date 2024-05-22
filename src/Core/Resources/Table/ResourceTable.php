<?php 

namespace Raakkan\Yali\Core\Resources\Table;
use Livewire\Component;
use Livewire\WithPagination;
use Raakkan\Yali\Core\Facades\YaliManager;
use Raakkan\Yali\Core\Resources\ResourceManager;
use Raakkan\Yali\Core\Resources\Table\YaliTable;

// TODO: pagination page/2 in url bar refresh if filter activated no data
class ResourceTable extends Component
{
    use WithPagination;

    public $resource;

    public $search = '';

    public $sortColumn;
    public $sortDirection;

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
        return $this->getResource()->table();
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

        $defaultSortColumn = $table->getDefaultSortableColumn();

        if (!empty($defaultSortColumn) && empty($this->sortColumn)) {
            $this->sortColumn = $this->sortColumn ?? $defaultSortColumn->getName();
            $this->sortDirection = $this->sortDirection ?? $defaultSortColumn->getSortDirection();
        }

        $queryBuilder->search($this->search)
                    ->sort($this->sortColumn, $this->sortDirection)
                    ->withTrashed()
                    ->applyFilters($table->getFilters(), $this->filterInputs);

        return $queryBuilder->paginate($table->getPerPage());
    }

    public function sortBy($column)
    {
        $sortColumn = collect($this->getTable()->getColumns())->firstWhere('name', $column);

        if ($this->sortColumn === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortColumn = $column;
        $sortColumn->sortDirection = $this->sortDirection;
        $this->resetPage();
    }

    public function clearSearch()
    {
        $this->search = '';
        $this->resetPage();
    }

    public function delete($id)
    {
        dd($id);
        $model = $this->getModel();
        $model->find($id)->delete();
        $this->resetPage();
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

    public function render()
    {
        $columns = $this->getTable()->getColumns();
        
        return view('yali::table.resource-table', [
            'columns' => $columns,
            'modelData' => $this->getModelData(),
            'filters' => $this->getTable()->getFilters(),
            'actions' => $this->getTable()->getActions(),
            'headerActions' => $this->getTable()->getHeaderActions(),
        ]);
    }
}
