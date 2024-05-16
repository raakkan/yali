<?php 

namespace Raakkan\Yali\Core\Resources\Table;
use Livewire\Component;
use Raakkan\Yali\Core\Resources\ResourceManager;
use Raakkan\Yali\Core\Resources\Table\YaliTable;

class ResourceTable extends Component
{
    public $resourceId;

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
        return $this->getTable()->getResourceModelQuery();
    }

    public function render()
    {
        $columns = $this->getTable()->getColumns();
        return view('yali::table.resource-table', [
            'columns' => $columns,
            'modelData' => $this->getModel()->select(['name', 'email'])->paginate($this->getTable()->getPagination()),
        ]);
    }
}
