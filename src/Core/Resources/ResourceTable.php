<?php 

namespace Raakkan\Yali\Core\Resources;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Raakkan\Yali\Core\Facades\YaliManager;
use Raakkan\Yali\Core\Concerns\Livewire\HasSearch;
use Raakkan\Yali\Core\Concerns\Livewire\HasFilters;
use Raakkan\Yali\Core\Concerns\Livewire\HasResource;
use Raakkan\Yali\Core\Concerns\Livewire\HasPagination;

// TODO: pagination page/2 in url bar refresh if filter activated no data
class ResourceTable extends Component
{
    use WithPagination;
    use HasFilters;
    use HasPagination;
    use HasResource;
    use HasSearch;

    public function mount($resource)
    {
        $this->resource = YaliManager::resolveResource($resource);
        
        $this->setFilterInputs();
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

    public function render()
    {
        // dd($this->getTable()->getHeaderActions());
        return view('yali::table.resource-table', [
            'columns' => $this->getTable()->getColumns(),
            'modelData' => $this->getModelData(),
            'filters' => $this->getTable()->getFilters(),
            'actions' => $this->getTable()->getActions(),
            'headerActions' => $this->getTable()->getHeaderActions(),
        ]);
    }
}
