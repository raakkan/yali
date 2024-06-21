<?php

namespace Raakkan\Yali\Core\Actions\Concerns;

use Raakkan\Yali\Core\View\Button;

trait ModalConfirmation
{
    public $confirmation = false;
    public $simpleConfirmation = false;
    public $confirmationTitle;
    public $confirmationMessage;

    public $confirmationButton;
    public $confirmationButtonLabel;
    public $confirmationButtonLoadingLabel;
    public $confirmationButtonCustomizeCallback;

    // Adding array for multiple before confirmation open callbacks
    protected $beforeConfirmationOpenCallbacks = [];

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

    public function confirmationTitle($title, $callback = null)
    {
        if (is_callable($title)) {
            $this->confirmationTitle = $title($this);
        } elseif (is_string($title)) {
            $this->confirmationTitle = $callback ? $callback($title, $this) : $title;
        }
        return $this;
    }

    public function getConfirmationTitle()
    {
        return $this->confirmationTitle ?? 'Delete Confirmation';
    }

    public function confirmationMessage($message, $callback = null)
    {
        if (is_callable($message)) {
            $this->confirmationMessage = $message($this);
        } elseif (is_string($message)) {
            $this->confirmationMessage = $callback ? $callback($message, $this) : $message;
        }
        return $this;
    }

    public function getConfirmationMessage()
    {
        return $this->confirmationMessage ?? 'Are you sure you want to do this record?';
    }

    public function confirmationButtonLoadingLabel($loadingLabel)
    {
        $this->confirmationButtonLoadingLabel = $loadingLabel;
        return $this;
    }

    public function getConfirmationButtonLoadingLabel()
    {
        return $this->confirmationButtonLoadingLabel ?? 'Deleting...';
    }

    public function getConfirmationButton()
    {
        $button = $this->confirmationButton;

        if (!$button) {
            $button = Button::make()
            ->classes(['btn', 'btn-danger', 'btn-sm', 'btn-full-width'])
            ->label($this->getConfirmationButtonLabel())
            ->setLoadingLabel($this->getConfirmationButtonLoadingLabel());
        }

        if (is_callable($this->confirmationButtonCustomizeCallback)) {
            $button = call_user_func($this->confirmationButtonCustomizeCallback, $button, $this);
        }

        $this->confirmationButton = $button;

        return $button;
    }

    public function getConfirmationButtonLabel()
    {
        return $this->confirmationButtonLabel;
    }

    public function confirmationButtonLabel($label)
    {
        $this->confirmationButtonLabel = $label;
        return $this;
    }

    public function cunstomizeSubmitButton($callback)
    {
        $this->confirmationButtonCustomizeCallback = $callback;
        return $this;
    }

    public function beforeConfirmationOpen(callable $callback, string $failureMessage)
    {
        $this->beforeConfirmationOpenCallbacks[] = [
            'callback' => $callback,
            'message' => $failureMessage,
        ];
        return $this;
    }

    public function triggerBeforeConfirmationOpen()
    {
        foreach ($this->beforeConfirmationOpenCallbacks as $item) {
            $callback = $item['callback'];
            if (!call_user_func($callback, $this)) {
                return $item['message'];
            }
        }
        return true;
    }
}
