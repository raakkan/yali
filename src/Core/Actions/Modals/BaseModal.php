<?php

namespace Raakkan\Yali\Core\Actions\Modals;

use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Raakkan\Yali\Core\Concerns\Livewire\HasRecords;

class BaseModal extends Component
{
    use HasRecords;

    public $openActionModal = false;

    public $sourceClass;

    public $actionClass;

    public $recordId;

    public $inputs = [];

    protected static $view;

    public function getAction()
    {
        return $this->sourceClass::getAction($this->actionClass, $this->getModel());
    }

    public function getModel()
    {
        if ($this->recordId) {
            return $this->getRecord($this->sourceClass::getModelQuery(), $this->sourceClass::getModelPrimaryKey(), $this->recordId);
        }else{
            return $this->sourceClass::getModel();
        }
    }

    public function confirmAction()
    {
        $action = $this->getAction();
        $action->setModel($this->getModel());

        $formData = null;
        if ($this->getAction()->hasForm()) {
            $form = $this->getAction()->getForm();
            $data = $this->inputs[$form->getId()];
            $formData = $this->validatedInputs($form, $data);
        }

        try {
            $action->execute($formData);

            if ($this instanceof ActionConfirmationModal) {
                $this->recordId = null;
            }
            
            $this->dispatch('refresh-page');
            $this->closeModal();
            $this->dispatch('toast', type: 'success', message: 'Successful');
        } catch (\Exception $e) {
            $this->dispatch('toast', type: 'error', message: $e->getMessage());
        }
    }

    public function cancelAction()
    {
        $this->closeModal();
    }

    public function openModal()
    {
        $result = $this->getAction()->triggerBeforeConfirmationOpen();
        if ($result === true) {
            $this->openActionModal = true;
        } else {
            $this->dispatch('toast', type: 'error', message: $result);
        }
    }

    public function closeModal()
    {
        $this->openActionModal = false;
    }

    public function render()
    {
        return view(static::$view)->layout('yali::layouts.app');
    }

    public function validatedInputs($form, $data)
    {
        $rules = $form->getValidationRules();
        
        $validated = Validator::make(
            $data,
            $rules,
            $form->getValidationMessages()
         )->validate();

        return $validated;
    }
}
