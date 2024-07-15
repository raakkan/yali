<?php

namespace Raakkan\Yali\Core\Forms\Concerns;

use Raakkan\Yali\Core\View\Button;

trait HasFormActions
{
    protected $formActionsPostion = 'justify-end';

    protected $extraActionButtons = [];

    protected $formHeaderButtons = [];

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
        } elseif ($position === 'left' || $position === 'right' || $position === 'start' || $position === 'end') {
            $this->formActionsPostion = $position === 'left' ? 'justify-start' : ($position === 'right' ? 'justify-end' : ($position === 'start' ? 'justify-start' : 'justify-end'));
        } elseif ($position === 'center') {
            $this->formActionsPostion = 'justify-center';
        } elseif ($position === 'between') {
            $this->formActionsPostion = 'justify-between';
        } elseif ($position === 'around') {
            $this->formActionsPostion = 'justify-around';
        } elseif ($position === 'evenly') {
            $this->formActionsPostion = 'justify-evenly';
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

    public function getFormHeaderButtons()
    {
        return $this->formHeaderButtons;
    }

    public function formHeaderButtons(Button ...$buttons)
    {
        $this->formHeaderButtons = $buttons;

        return $this;
    }
}
