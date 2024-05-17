<?php

namespace Raakkan\Yali\Core\Actions;

abstract class YaliAction
{
    protected string $label;
    protected string $class;
    protected string $icon;
    protected bool $visible;
    protected string $confirmationMessage;
    protected string $permission;

    public function __construct(
        string $label,
        string $class = '',
        string $icon = '',
        bool $visible = true,
        string $confirmationMessage = '',
        string $permission = ''
    ) {
        $this->label = $label;
        $this->class = $class;
        $this->icon = $icon;
        $this->visible = $visible;
        $this->confirmationMessage = $confirmationMessage;
        $this->permission = $permission;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getClass(): string
    {
        return $this->class;
    }

    public function getIcon(): string
    {
        return $this->icon;
    }

    public function isVisible(): bool
    {
        return $this->visible;
    }

    public function setVisible(bool $visible): void
    {
        $this->visible = $visible;
    }

    public function getConfirmationMessage(): string
    {
        return $this->confirmationMessage;
    }

    public function setConfirmationMessage(string $message): void
    {
        $this->confirmationMessage = $message;
    }

    public function getPermission(): string
    {
        return $this->permission;
    }

    public function hasPermission($user): bool
    {
        return $user->can($this->permission);
    }

    abstract public function render($data): string;
}
