<?php

namespace Raakkan\Yali\Core\Actions;
use Raakkan\Yali\Core\Traits\Makable;
use Raakkan\Yali\Core\View\YaliComponent;

abstract class YaliAction extends YaliComponent
{
    use Makable;

    protected string $label;
    protected string $class;
    protected string $icon;
    protected bool $visible;
    protected string $confirmationMessage;
    protected string $permission;

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

    abstract public function handle($model);
    abstract public function render($data);
}
