<?php 

namespace Raakkan\Yali\App;

use Livewire\Component;
use Raakkan\Yali\Core\Pages\YaliPage;
use Raakkan\Yali\Core\Resources\ResourceManager;

class ResourcePage extends YaliPage
{
    public $resourceId;
    public $modelData;
    protected $view = 'yali::pages.resource-page';

    public function mount($resourceId)
    {
        $resourceData = app(ResourceManager::class)->getResource($resourceId);

        if (!$resourceData) {
            abort(404, sprintf('Resource with id %s not found', $resourceId));
        }

        $resource = new $resourceData['class']();
        $model = $resource->getModel();
        
        $this->modelData = $model::all();
    }
}
