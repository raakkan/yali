<?php

namespace Raakkan\Yali\Core\Forms\Concerns;

use Raakkan\Yali\Core\View\Button;

trait HasFormActions
{
    protected $formActionsPostion = 'justify-end';
    protected $extraActionButtons = [];

    public function getFormActionsPosition()
    {
        return $this->formActionsPostion;
    }

    public function formActionsPosition($position)
    {
        if ($position instanceof \BackedEnum) {
            $position = $position->value;
        }

        if (strpos($position, 'justify-') !== false) {
            $this->formActionsPostion = $position;
        } elseif ($position === 'left' || $position === 'right') {
            $this->formActionsPostion = $position === 'left' ? 'justify-start' : 'justify-end';
        } elseif ($position === 'end' || $position === 'start') {
            $this->formActionsPostion = $position === 'end' ? 'justify-end' : 'justify-start';
        } else {
            $this->formActionsPostion = 'justify-end';
        }

        return $this;
    }

    public function getExtraActionButtons()
    {
        return $this->extraActionButtons;
    }

    public function extraActionButtons(Button ...$buttons)
    {
        $this->extraActionButtons = $buttons;
        return $this;
    }
}
