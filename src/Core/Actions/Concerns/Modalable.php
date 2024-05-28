<?php 

namespace Raakkan\Yali\Core\Actions\Concerns;

trait Modalable
{
    protected bool $isModal = false;
    public $confirmation = false;

    protected $modalData = [
        'slideLeft' => false,
        'slideRight' => false,
        'slideUp' => false,
        'slideDown' => false,
    ];

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

    public function isModal()
    {
        return $this->isModal;
    }

    public function modal(bool $slideLeft = false, bool $slideRight = false, bool $slideUp = false, bool $slideDown = false)
    {
        $this->isModal = true;
        
        if ($slideLeft) {
            $this->modalData['slideLeft'] = true;
        }
        if ($slideRight) {
            $this->modalData['slideRight'] = true;
        }
        if ($slideUp) {
            $this->modalData['slideUp'] = true;
        }
        if ($slideDown) {
            $this->modalData['slideDown'] = true;
        }
        return $this;
    }

    public function getModalPosition()
    {
        if ($this->modalData['slideLeft']) {
            return 'left';
        } elseif ($this->modalData['slideRight']) {
            return 'right';
        } elseif ($this->modalData['slideUp']) {
            return 'bottom';
        } elseif ($this->modalData['slideDown']) {
            return 'top';
        }
        
        return 'center';
    }

    public function getModalData()
    {
        return $this->modalData;
    }

}