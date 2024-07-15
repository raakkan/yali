<?php

namespace Raakkan\Yali\Core\Forms\Concerns;

use Raakkan\Yali\Core\View\Button;

trait HasSubmitButton
{
    protected $submitButton;

    protected $submitButtonLabel = '';

    protected $submitButtonCallback;

    public function getSubmitButton()
    {
        if (! $this->submitButton) {
            $this->submitButton = Button::make()
                ->classes(['btn', 'btn-sm'])
                ->submit()
                ->setLabel($this->getSubmitButtonLabel());
        }

        if ($this->submitButtonCallback) {
            call_user_func($this->submitButtonCallback, $this->submitButton);
        }

        return $this->submitButton;
    }

    public function setSubmitButton(Button $button)
    {
        $this->submitButton = $button;

        return $this;
    }

    public function getSubmitButtonLabel()
    {
        return $this->submitButtonLabel ?: 'Submit';
    }

    public function setSubmitButtonLabel($label)
    {
        $this->submitButtonLabel = $label;

        return $this;
    }

    public function customizeSubmitButton(callable $callback)
    {
        $this->submitButtonCallback = $callback;

        return $this;
    }
}
