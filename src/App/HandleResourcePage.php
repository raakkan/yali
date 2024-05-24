<?php

namespace Raakkan\Yali\App;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Raakkan\Yali\Core\Facades\YaliManager;

class HandleResourcePage extends Component
{
    public $resource;
    protected $view = 'yali::pages.handle-resource-page';
    public $model;

    public $data = [];

    public function mount(Request $request, $modelKey = null)
    {
        $this->resource = YaliManager::resolveResource($request->route('resource'));

        if ($modelKey) {
            $this->model = $this->getModel()->find($modelKey);
        } else {
            $this->model = $this->getModel();
        }

        $this->fillForm();
    }
    
    public function fillForm()
    {
        foreach ($this->getForm()->getFields() as $field) {
            if ($field->getType() !== 'password') {
                $this->data[$field->getName()] = $this->model->{$field->getName()} ?? $field->getDefault();
            }
        }
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

    public function getTitle()
    {
        if (is_null($this->model->id)) {
            return 'Create '. $this->getResource()->getTitle();
        } else {
            return 'Edit '. $this->getResource()->getTitle();
        }
    }

    public function getForm()
    {
        return $this->getResource()->form();
    }

    public function submit()
    {
        $validatedData = $this->validatedInputs();

        if (is_null($this->model->id)) {
            $this->model->create($validatedData);
            $this->dispatch('toast', type: 'success', message: $this->getResource()->getModelName() . ' has been created.');
        } else {
            $this->model->update($validatedData);
            $this->dispatch('toast', type: 'success', message: $this->getResource()->getModelName() . ' has been updated.');
        }
    }

    public function validatedInputs()
    {
        $rules = $this->getValidationRules();
        if ($this->model->id) {
            foreach ($this->getForm()->getFields() as $field) {
                if ($field->getType() === 'password') {
                    if (empty($this->data[$field->getName()])) {

                        // If the field is a password field and the input is empty,
                        // remove the confirmation field rule and the confirmation field itself from the rules array.
                        if (array_key_exists($field->getName(), $rules)) {
                            foreach ($rules[$field->getName()] as $key => $rule) {
                                if (is_string($rule) && Str::contains($rule, 'confirmed')) {
                                    $confirmationFieldName = explode(':', $rule)[1];
                                    unset($rules[$confirmationFieldName]);
                                }
                            }
                        }

                        // If the field is a confirmation field, remove it from the rules array.
                        if ($field->isConfirm()) {
                            unset($rules[$field->getName()]);
                        }
                    }
                }
            }
        }
        
        $validated = Validator::make(
            $this->data,
            $rules,
         )->validate();

        return $validated;
    }

    public function getValidationRules()
    {
        return $this->getForm()->getValidationRules();
    }

    public function render()
    {
        return view($this->view, [
            'fields' => $this->getForm()->getFields(),
        ])->layout('yali::layouts.app');
    }
}
