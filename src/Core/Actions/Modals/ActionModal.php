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
                $this->inputs[$this->getForm()->getId()][$field->getName()] = $this->getModel()->{$field->getName()} ?? $field->getDefault();
            }
        }
    }

    public function getForm()
    {
        return $this->sourceClass::form($this->sourceClass::getForm())->setLivewire($this)->setModel($this->getModel());
    }
}