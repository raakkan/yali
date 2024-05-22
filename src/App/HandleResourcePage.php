<?php

namespace Raakkan\Yali\App;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Raakkan\Yali\Core\Facades\YaliManager;

class HandleResourcePage extends Component
{
    public $resource;
    protected $view = 'yali::pages.handle-resource-page';
    public $model;

    public function mount(Request $request, $modelKey)
    {
        $this->resource = YaliManager::resolveResource($request->route('resource'));

        $this->model = $this->getModel()->find($modelKey);
    }

    public function getResource()
    {
        $resource = $this->resource['class'];
        return new $resource();
    }

    public function getModel()
    {
        return $this->getResource()->getModelInstance();
    }

    public function render()
    {
        return view($this->view)->layout('yali::layouts.app');
    }
}
