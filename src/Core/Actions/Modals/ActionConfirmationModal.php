<?php

namespace Raakkan\Yali\Core\Actions\Modals;

use Livewire\Component;
use Raakkan\Yali\Core\Concerns\Livewire\HasRecords;

class ActionConfirmationModal extends Component
{
    use HasRecords;

    public $openModal = false;

    public $sourceClass;

    public $actionClass;

    public $recordId;

    public $showWizardOrForm = false;

    public function mount()
    {
        // dd($this->getRecordModel());
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
        $result = $action->execute();
        dd($result);
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
        $this->showWizardOrForm = false;
    }

    public function render()
    {
        return view('yali::actions.modals.action-confirmation-modal')->layout('yali::layouts.app');
    }  
}
