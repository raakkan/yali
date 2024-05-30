<?php

namespace Raakkan\Yali\Core\Actions;

use Livewire\Component;
use Illuminate\Support\Facades\Log;
use Raakkan\Yali\Core\Forms\Concerns\InteractsWithForms;
use Raakkan\Yali\Core\Forms\Contracts\HasForms;
use Raakkan\Yali\Core\Forms\YaliForm;
use Raakkan\Yali\Core\Resources\YaliResource;

class ModalComponent extends Component implements HasForms
{
    use InteractsWithForms;

    public $source;

    public $action;

    public $modalType = '';
    
    public function mount($data)
    {
        if (is_array($data) && array_key_exists('model', $data) && array_key_exists('source', $data) && array_key_exists('action', $data)) {
            $this->source = $data['source'];
            $this->model = $data['model'];
            $this->action = $data['action'];
            $this->fillForm();
        }
    }

    public function getSource()
    {
        $source = $this->source;
        return new $source();
    }

    public function getForm()
    {
        $source = $this->getSource();
        
        if ($source instanceof YaliResource) {
            $form = $this->getSource()->form($this->getSource()->getForm());
            $form->setResource($this->getSource())->modal(...$this->getAction()->getModalData());
        }else {
            $form = $this->getSource()->form($this->getSource()->getForm());
        }
        
        return $form;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function getAction()
    {
        $source = $this->getSource();
        if ($source instanceof YaliResource) {
            $action = $this->getSource()->getAction($this->action)->setSource($this->getSource());
        }else {
            $action = $this->getSource()->getAction();
        }

        return $action;
    }

    public function submit()
    {
        $validatedData = $this->validatedInputs();
        
        if (is_null($this->model->id)) {
            $this->model = $this->model->create($validatedData);
            $this->dispatch('modal-close');
            $this->dispatch('toast', type: 'success', message: $this->getSourceName() . ' has been created.');
            $this->dispatch('refresh-page');
        } else {
            $this->model->update($validatedData);
            $this->dispatch('modal-close');
            $this->dispatch('toast', type: 'success', message: $this->getSourceName() . ' has been updated.');
            $this->dispatch('refresh-page');
        }
    }

    public function getSourceName()
    {
        if($this->getSource() instanceof YaliResource) {
            return $this->getSource()->getModelName();
        }

        // TODO: get source name
        return class_basename(get_class($this->model));
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
