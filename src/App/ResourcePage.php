<?php 

namespace Raakkan\Yali\App;

use Livewire\Component;
use Illuminate\Http\Request;

class ResourcePage extends Component
{
    public $resource;
    protected $view = 'yali::pages.resource-page';
    public $model;

    public function mount(Request $request)
    {
        $this->resource = $request->route('resource');

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
        return view($this->view)->layout('yali::layouts.app');
    }
}
