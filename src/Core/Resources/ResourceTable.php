<?php 

namespace Raakkan\Yali\Core\Resources;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Raakkan\Yali\Core\Facades\YaliManager;
use Raakkan\Yali\Core\Concerns\Livewire\HasSearch;
use Raakkan\Yali\Core\Concerns\Livewire\HasFilters;
use Raakkan\Yali\Core\Concerns\Livewire\HasRecords;
use Raakkan\Yali\Core\Resources\Concerns\HasResource;
use Raakkan\Yali\Core\Concerns\Livewire\HasPagination;

// TODO: pagination page/2 in url bar refresh if filter activated no data
class ResourceTable extends Component
{
    use WithPagination;
    use HasFilters;
    use HasPagination;
    use HasResource;
    use HasSearch;
    use HasRecords;

    public function mount($resource)
    {
        $this->resource = YaliManager::resolveResource($resource);
        
        $this->setFilterInputs();
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
        $query = $this->getQuery();

        $this->setSearchColumns($this->getTable()->getSearchableColumns());
        
        $this->setPerPage($this->getTable()->getPerPage());

        return view('yali::table.resource-table', [
            'columns' => $this->getTable()->getColumns(),
            'modelData' => $this->getRecords($query),
            'filters' => $this->getTable()->getFilters(),
            'actions' => $this->getTable()->getActions(),
            'headerActions' => $this->getTable()->getHeaderActions(),
        ]);
    }
}
