<?php

namespace Raakkan\Yali\Core\Actions\Modals;

class ActionConfirmationModal extends BaseModal
{
    protected static $view = 'yali::actions.modals.action-confirmation-modal';

    public $showWizardOrForm = false;

    public function mount()
    {
        if ($this->getAction()->hasForm()) {
            $fields = $this->getAction()->getForm()->getFields();

            foreach ($fields as $field) {
                $this->form[$this->getAction()->getForm()->getId()]['inputs'][$field->getName()] = '';
            }
        }
    }

    public function closeModal()
    {
        $this->openActionModal = false;
        $this->showWizardOrForm = false;
    }
}
