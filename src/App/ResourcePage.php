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
    public $model;
    public $modelInstance;
    public $fields;
    public $dynamicProperties = [];

    public function mount($model, $fields)
    {
        $this->model = $model;
        $this->fields = $fields;
        $this->modelInstance = new $this->model;

        // Initialize the dynamic properties with the model instance values
        foreach ($this->fields as $field) {
            $this->dynamicProperties[$field['name']] = $this->modelInstance->{$field['name']};
        }
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
}
