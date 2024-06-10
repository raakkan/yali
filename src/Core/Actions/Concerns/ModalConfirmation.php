<?php

namespace Raakkan\Yali\Core\Actions\Concerns;

trait ModalConfirmation
{
    public $confirmation = false;
    public $confirmationTitle;
    public $confirmationMessage;

    public function confirmation($confirmation = true)
    {
        $this->confirmation = $confirmation;
        return $this;
    }
    
    public function getConfirmation()
    {
        return $this->confirmation;
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
}
