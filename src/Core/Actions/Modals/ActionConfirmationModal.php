<?php

namespace Raakkan\Yali\Core\Actions\Modals;

use Livewire\Component;

class ActionConfirmationModal extends Component
{
    public $openModal = false;

    public $sourceClass;

    public $actionClass;

    public $recordId;

    public $showWizardOrForm = false;

    public function mount()
    {
        // dd($this->getAction());
    }

    public function getAction()
    {
        return $this->sourceClass::getAction($this->actionClass);
    }

    public function confirmAction()
    {
        $action = $this->getAction();
        $action->setModel($this->sourceClass::getModel()->find($this->recordId));
        $action->execute();
        $this->dispatch('refresh-page');
        $this->closeModal();
        $this->dispatch('toast', type: 'success', message: 'Successful');
    }

    public function cancelAction()
    {
        $this->closeModal();
    }

    public function closeModal()
    {
        $this->openModal = false;
    }

    public function render()
    {
        return view('yali::actions.modals.action-confirmation-modal')->layout('yali::layouts.app');
    }  
}
