<?php

namespace Raakkan\Yali\Core\Forms\Concerns;

use Raakkan\Yali\Core\View\Button;

trait HasSubmitButton
{
    protected $submitButton;
    protected $submitButtonLabel = '';

    protected $createSubmitButtonLabel = '';
    protected $updateSubmitButtonLabel = '';

    public function getSubmitButton()
    {
        if (!$this->submitButton) {
            $this->submitButton = Button::make()
                ->classes(['btn', 'btn-sm'])
                ->submit()
                ->setLabel($this->getSubmitButtonLabel());
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

    public function getCreateSubmitButtonLabel(): string
    {
        return $this->createSubmitButtonLabel ?: 'Create';
    }

    public function getUpdateSubmitButtonLabel(): string
    {
        return $this->updateSubmitButtonLabel ?: 'Update';
    }
}
