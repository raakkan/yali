<?php

namespace Raakkan\Yali\Core\Actions;

use Livewire\Component;
use Illuminate\Support\Facades\Log;
use Raakkan\Yali\Core\Forms\Concerns\InteractsWithForms;
use Raakkan\Yali\Core\Forms\Contracts\HasForms;
use Raakkan\Yali\Core\Forms\YaliForm;

class ModalComponent extends Component implements HasForms
{
    use InteractsWithForms;

    public $resource;

    public $action;

    public $modalType = '';
    
    public function mount($data)
    {
        if (is_array($data) && array_key_exists('model', $data) && array_key_exists('type', $data) && array_key_exists('action', $data)) {
            if ($data['type'] == 'resource_form_action') {
                $this->resource = $data['resource'];
            }
            $this->model = $data['model'];
            $this->action = $data['action'];
            $this->modalType = $data['type'];
            $this->fillForm();
        }
    }

    public function getResource()
    {
        $resource = $this->resource;
        return new $resource();
    }

    public function getForm()
    {
        if ($this->modalType == 'resource_form_action') {
            $form = $this->getResource()->form($this->getResource()->getForm());
            $form->setResource($this->getResource())->modal(...$this->getAction()->getModalData());
        }

        if ($this->modalType == 'form_action') {
            $form = $this->getResource()->form($this->getResource()->getForm());
        }
        
        return $form;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function getAction()
    {
        return $this->getResource()->getAction($this->action)->setResource($this->getResource());
    }

    public function submit()
    {
        $validatedData = $this->validatedInputs();
        
        if (is_null($this->model->id)) {
            $this->model = $this->model->create($validatedData);
            $this->dispatch('modal-close');
            $this->dispatch('toast', type: 'success', message: $this->getResource()->getModelName() . ' has been created.');
            $this->dispatch('refresh-page');
        } else {
            $this->model->update($validatedData);
            $this->dispatch('modal-close');
            $this->dispatch('toast', type: 'success', message: $this->getResource()->getModelName() . ' has been updated.');
            $this->dispatch('refresh-page');
        }
    }

    public function cancel()
    {
        // this is automatically reseted validation errors
    }

    public function render()
    {
        return view('yali::actions.modal-component')->layout('yali::layouts.app');
    }
}
