<?php

namespace Raakkan\Yali\Core\Support\Concerns\Components;

use Raakkan\Yali\Core\View\Button;

trait HasButton
{
    protected $button;

    protected $buttonCallback;

    protected $buttonIsLink = false;

    protected $linkTarget;

    public function initializeHasButton()
    {
        $this->button = Button::make();

    }

    public function getButton()
    {
        if (count($this->buttonClasses()) > 0) {
            $this->button->classes($this->buttonClasses());
        } else {
            if (method_exists($this, 'getClassesArray')) {
                $this->button->classes($this->getClassesArray());
            }
        }

        if (count($this->buttonStyles()) > 0) {
            $this->button->styles($this->buttonStyles());
        } else {
            if (method_exists($this, 'getStylesArray')) {
                $this->button->styles($this->getStylesArray());
            }
        }

        if ($this->buttonLabel()) {
            $this->button->setLabel($this->buttonLabel());
        } else {
            if (method_exists($this, 'getLabel')) {
                $this->button->setLabel($this->getLabel());
            }
        }

        if ($this->buttonHasAttributes()) {
            $this->button->setAttributes($this->buttonAttributes());
        }

        if ($this->buttonIsLink()) {
            $this->button->setUrl($this->getButtonUrl());

            if (isset($this->linkTarget) && $this->linkTarget) {
                $this->button->setTarget($this->linkTarget);
            }
        }

        if ($this->buttonCallback) {
            call_user_func($this->buttonCallback, $this->button);
        }

        return $this->button;
    }

    public function onButtonCreation(callable $callback)
    {
        $this->buttonCallback = $callback;

        return $this;
    }

    public function buttonClasses()
    {
        return [];
    }

    public function buttonStyles()
    {
        return [];
    }

    public function buttonLabel()
    {
        return '';
    }

    public function buttonAttributes()
    {
        return [];
    }

    public function buttonHasAttributes()
    {
        return count($this->buttonAttributes()) > 0;
    }

    public function buttonIsLink()
    {
        return $this->buttonIsLink;
    }

    public function getButtonUrl()
    {
        return '#';
    }
}
