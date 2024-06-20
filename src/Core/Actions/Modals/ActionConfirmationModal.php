<?php

namespace Raakkan\Yali\Core\Actions\Modals;

use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Raakkan\Yali\Core\Concerns\Livewire\HasRecords;

class ActionConfirmationModal extends Component
{
    use HasRecords;

    public $openModal = false;

    public $sourceClass;

    public $actionClass;

    public $recordId;

    public $showWizardOrForm = false;

    public $inputs = [];

    public function mount()
    {
        if ($this->getAction()->hasForm()) {
            $fields = $this->getAction()->getForm()->getFields();

            foreach ($fields as $field) {
                $this->inputs[$this->getAction()->getForm()->getId()][$field->getName()] = '';
            }
        }
    }

    public function getAction()
    {
        return $this->sourceClass::getAction($this->actionClass, $this->getRecordModel());
    }

    public function getRecordModel()
    {
        return $this->getRecord($this->sourceClass::getModelQuery(), $this->sourceClass::getModelPrimaryKey(), $this->recordId);
    }

    public function confirmAction()
    {
        $action = $this->getAction();
        $action->setModel($this->getRecordModel());

        $formData = null;
        if ($this->getAction()->hasForm()) {
            $formData = $this->validatedInputs();
        }

        try {
            $action->execute($formData);
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

    public function closeModal()
    {
        $this->openModal = false;
        $this->showWizardOrForm = false;
    }

    public function render()
    {
        return view('yali::actions.modals.action-confirmation-modal')->layout('yali::layouts.app');
    }

    public function validatedInputs()
    {
        $rules = $this->getAction()->getForm()->getValidationRules();
        
        $validated = Validator::make(
            $this->inputs[$this->getAction()->getForm()->getId()],
            $rules,
            $this->getAction()->getForm()->getValidationMessages()
         )->validate();

        return $validated;
    }
}
