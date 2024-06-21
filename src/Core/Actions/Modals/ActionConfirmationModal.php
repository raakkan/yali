<?php

namespace Raakkan\Yali\Core\Actions\Modals;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Raakkan\Yali\Core\Concerns\Livewire\HasRecords;

class ActionConfirmationModal extends BaseModal
{
    protected static $view = 'yali::actions.modals.action-confirmation-modal';
    public $showWizardOrForm = false;

    public function mount()
    {
        if ($this->getAction()->hasForm()) {
            $fields = $this->getAction()->getForm()->getFields();

            foreach ($fields as $field) {
                $this->inputs[$this->getAction()->getForm()->getId()][$field->getName()] = '';
            }
        }
    }
    
    public function closeModal()
    {
        $this->openActionModal = false;
        $this->showWizardOrForm = false;
    }
}
