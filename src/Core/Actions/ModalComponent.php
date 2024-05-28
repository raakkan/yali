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
    
    public function mount($data)
    {
        if (is_array($data) && array_key_exists('model', $data) && array_key_exists('resource', $data) && array_key_exists('action', $data)) {
            $this->resource = $data['resource'];
            $this->model = $data['model'];
            $this->action = $data['action'];
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
        $form = $this->getResource()->form($this->getResource()->getForm());
        return $form->modal(...$this->getAction()->getModalData());
    }

    public function getModalPosition()
    {
        return $this->getAction()->getModalPosition();
    }

    public function getModel()
    {
        return $this->model;
    }

    public function getAction()
    {
        return $this->getResource()->getAction($this->action)->setResource($this->getResource());
    }

    public function getTriggerButton()
    {
        return $this->getAction()->getButton();
    }

    public function submit()
    {
        $validatedData = $this->validatedInputs();
    }

    public function render()
    {
        // Log::info($this->__id);

        return view('yali::actions.modal-component');
    }
}
