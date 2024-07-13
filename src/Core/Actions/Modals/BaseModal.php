<?php

namespace Raakkan\Yali\Core\Actions\Modals;

use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Raakkan\Yali\Core\Resources\Actions\EditAction;
use Raakkan\Yali\Core\Resources\Actions\CreateAction;
use Raakkan\Yali\Core\Support\Concerns\Livewire\HasRecords;

class BaseModal extends Component
{
    use HasRecords;

    public $openActionModal = false;

    public $sourceClass;

    public $actionClass;
    public $actionAdditionalData = [];

    public $recordId;

    public $form = [];

    protected static $view;

    public function getAction()
    {
        return $this->sourceClass::getAction($this->actionClass, $this->getModel())->setAdditionalData($this->actionAdditionalData);
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
        $form = null;

        if ($this->getAction()->hasForm()) {
            $form = $this->getAction()->getForm();
        }

        if(is_null($form) && method_exists($this,'getForm')) {
            $form = $this->getForm();
        }

        if(!is_null($form)) {
            $data = $this->form[$form->getId()]['inputs'];
            $formData = $this->validatedInputs($form, $data);

            foreach ($formData as $name => $value) {
                $form->setFieldValue($name, $value);

                if (isset($this->form[$form->getId()]['old.inputs'][$name])) {
                    $form->setOldFieldValue($name, $this->form[$form->getId()]['old.inputs'][$name]);
                }
            }
        }

        try {
            $action->execute($form);

            if ($this instanceof ActionConfirmationModal) {
                $this->recordId = null;
            }
            
            $this->dispatch('refresh-page');
            $this->closeModal();
            $this->dispatch('toast', type: 'success', message: $this->getAction()->getSuccessMassage());
        } catch (\Exception $e) {
            $this->dispatch('toast', type: 'error', message: $e->getMessage());
            // throw $e;
        }
    }

    public function cancelAction()
    {
        $this->closeModal();
    }

    public function openModal()
    {
        $this->dispatch('notifications-sent');
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
        $validated = Validator::make(
            $data,
            $form->getValidationRules(),
            $form->getValidationMessages()
         )->validate();

        return $validated;
    }

    public function getTitle()
    {
        if ($this->getAction() instanceof EditAction) {
            return $this->sourceClass::getUpdateTitle();
        }elseif ($this->getAction() instanceof CreateAction) {
            return $this->sourceClass::getCreateTitle();
        }
    }

    public function getSubmitButtonLabel()
    {
        if ($this->getAction() instanceof EditAction) {
            return $this->sourceClass::getUpdateButtonLabel();
        }elseif ($this->getAction() instanceof CreateAction) {
            return $this->sourceClass::getCreateButtonLabel();
        }
    }
}
