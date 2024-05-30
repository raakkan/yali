<?php

namespace Raakkan\Yali\Core\Actions\Concerns;

trait HasLabel
{
    protected string $label;

    public function label($label)
    {
        $this->label = $label;
        return $this;
    }

    public function getLabel()
    {
        return $this->label ?? 'Action';
    }

    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }
}
