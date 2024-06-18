<?php

namespace Raakkan\Yali\Core\Actions\Concerns;

trait ModalConfirmation
{
    public $confirmation = false;
    public $simpleConfirmation = false;
    public $confirmationTitle;
    public $confirmationMessage;

    public $loadingLabel;

    public function confirmation($confirmation = true, $simpleConfirmation = false)
    {
        $this->confirmation = $confirmation;
        $this->simpleConfirmation = $simpleConfirmation;

        if (property_exists($this, 'isModal') && $this->isModal) {
            $this->isModal = false;
        }

        return $this;
    }
    
    public function isConfirmation()
    {
        return $this->confirmation;
    }

    public function simpleConfirmation($confirmation = true)
    {
        $this->confirmation = $confirmation;
        $this->simpleConfirmation = $confirmation;

        if (property_exists($this, 'isModal') && $this->isModal) {
            $this->isModal = false;
        }
        
        return $this;
    }

    public function isSimpleConfirmation()
    {
        return $this->simpleConfirmation;
    }

    public function confirmationTitle($title)
    {
        $this->confirmationTitle = $title;
        return $this;
    }

    public function getConfirmationTitle()
    {
        return $this->confirmationTitle ?? 'Delete Confirmation';
    }

    public function confirmationMessage($message)
    {
        $this->confirmationMessage = $message;
        return $this;
    }

    public function getConfirmationMessage()
    {
        return $this->confirmationMessage ?? 'Are you sure you want to do this record?';
    }

    public function loadingLabel($loadingLabel)
    {
        $this->loadingLabel = $loadingLabel;
        return $this;
    }

    public function getLoadingLabel()
    {
        return $this->loadingLabel ?? 'Deleting...';
    }
}
