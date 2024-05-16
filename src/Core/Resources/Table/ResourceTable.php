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

    public function getModel()
    {
        return $this->getTable()->getResourceModel();
    }

    public function getModelData()
    {
        $query = $this->getModel()->query();

        $defaultSortColumn = $this->getTable()->getDefaultSortableColumn();

        if (!empty($defaultSortColumn) && empty($this->sortColumn)) {
            $this->sortColumn = $this->sortColumn ?? $defaultSortColumn->getName();
            $this->sortDirection = $this->sortDirection ?? $defaultSortColumn->getSortDirection();
        }

        if ($this->search) {
            $columns = $this->getTable()->getSearchableColumns();
            if (!empty($columns)) {
                $query->where(function ($q) use ($columns) {
                    foreach ($columns as $column) {
                        $q->orWhere($column, 'like', '%' . $this->search . '%');
                    }
                });
            }
        }

        if ($this->sortColumn) {
            $query->orderBy($this->sortColumn, $this->sortDirection);
        }

        if ($this->getTable()->isSoftDeletesEnabled()) {
            $query->withTrashed();
        }

        return $query->paginate($this->getTable()->getPagination());
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

    public function render()
    {
        $columns = $this->getTable()->getColumns();
        return view('yali::table.resource-table', [
            'columns' => $columns,
            'modelData' => $this->getModelData(),
        ]);
    }
}
