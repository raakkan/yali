<?php

namespace Raakkan\Yali\Core\Actions\Concerns;

trait Iconable
{
    protected ?string $icon = null;

    public function setIcon(string $icon): self
    {
        $this->icon = $icon;
        return $this;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function hasIcon(): bool
    {
        return !is_null($this->icon);
    }

    public function removeIcon(): self
    {
        $this->icon = null;
        return $this;
    }
}
