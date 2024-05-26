<?php 

namespace Raakkan\Yali\Core\Actions\Concerns;

trait Modalable
{
    public $confirmation = false;

    public $confirmationTitle = 'Delete Item';
    public $confirmationMessage = 'Are you sure you want to delete this item?';

    public function confirmation($confirmation = true)
    {
        $this->confirmation = $confirmation;
        return $this;
    }
    
    public function getConfirmation()
    {
        return $this->confirmation;
    }

    public function getConfirmationMessage()
    {
        return $this->confirmationMessage;
    }

    public function confirmationMessage($message)
    {
        $this->confirmationMessage = $message;
        return $this;
    }

    public function getConfirmationTitle()
    {
        return $this->confirmationTitle;
    }

    public function confirmationTitle($title)
    {
        $this->confirmationTitle = $title;
        return $this;
    }
}