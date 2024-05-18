<?php 

namespace Raakkan\Yali\Core\Resources\Table;
use Livewire\Component;
use Livewire\WithPagination;
use Raakkan\Yali\Core\Resources\ResourceManager;
use Raakkan\Yali\Core\Resources\Table\YaliTable;

class ResourceTable extends Component
{
    use WithPagination;
    public $resourceId;

    public $search = '';

    public $sortColumn;
    public $sortDirection;

    public $filterInputs = [];

    public function mount($resourceId)
    {
        $this->resourceId = $resourceId;
    }

    public function getResource()
    {
        return app(ResourceManager::class)->getResource($this->resourceId);
    }

    public function getTable()
    {
        return $this->getResource()->table();
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
                    ->applyFilters($table->getFilters());

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
        $model = $this->getModel();
        $model->find($id)->delete();
        $this->resetPage();
    }

    public function updatedFilterInputs($value, $filterName)
    {
        $filter = collect($this->getTable()->getFilters())->firstWhere('name', $filterName);
        $filter->value($value === 1 ? true : false);
        $this->resetPage();
        dd($filter);
    }

    public function render()
    {
        $columns = $this->getTable()->getColumns();
        return view('yali::table.resource-table', [
            'columns' => $columns,
            'modelData' => $this->getModelData(),
            'filters' => $this->getTable()->getFilters(),
        ]);
    }
}
