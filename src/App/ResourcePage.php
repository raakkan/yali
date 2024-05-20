<?php 

namespace Raakkan\Yali\App;

use Livewire\Component;
use Illuminate\Http\Request;
use Raakkan\Yali\Core\Pages\YaliPage;
use Raakkan\Yali\Core\Facades\YaliManager;
use Raakkan\Yali\Core\Resources\YaliResource;
use Raakkan\Yali\Core\Resources\ResourceManager;

class ResourcePage extends Component
{
    public $resourceId;
    protected $view = 'yali::pages.resource-page';
    public $model;

    public function mount(Request $request)
    {
        dd(YaliManager::resolveResource($request->route('resource')));;

        // dd($resource->getFields());

        // $this->model = $model;
        // $this->fields = $fields;
        // $this->modelInstance = new $this->model;

        // // Initialize the dynamic properties with the model instance values
        // foreach ($this->fields as $field) {
        //     $this->dynamicProperties[$field['name']] = $this->modelInstance->{$field['name']};
        // }
    }

    public function create()
    {
        $validatedData = $this->validate($this->getValidationRules());
        $this->model::create($validatedData);
        $this->resetDynamicProperties();
    }

    public function read()
    {
        return $this->model::all();
    }

    protected function getValidationRules()
    {
        $rules = [];
        foreach ($this->fields as $field) {
            $rules['dynamicProperties.'.$field['name']] = $field['rules'] ?? 'nullable';
        }
        return $rules;
    }

    public function render()
    {
        $resource = app(ResourceManager::class)->getResource($this->resourceId);
        
        return view($this->view, [
        ]);
    }
}
