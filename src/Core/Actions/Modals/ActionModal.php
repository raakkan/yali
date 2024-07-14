<?php

namespace Raakkan\Yali\Core\Actions\Modals;

use Livewire\Livewire;
use function Livewire\store;

class ActionModal extends BaseModal
{
    protected static $view = 'yali::actions.modals.action-modal';

    public function mount()
    {
        if ($this->getForm()) {
            $fields = $this->getForm()->getFields();

            foreach ($fields as $field) {
                $modelValue = $this->getModel()->{$field->getName()};

                $this->form[$this->getForm()->getId()]['inputs'][$field->getName()] = $modelValue ?? $field->getDefault();

                if (isset($modelValue)) {
                    $this->form[$this->getForm()->getId()]['old.inputs'][$field->getName()] = $modelValue;
                }
            }
        }
    }

    public function getForm()
    {
        $form = $this->sourceClass::form($this->sourceClass::getForm())->setLivewire($this)->setModel($this->getModel());
        $form->setWireModel('form.' . $form->getId());
        return $form;
    }
}