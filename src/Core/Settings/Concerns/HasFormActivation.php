<?php

namespace Raakkan\Yali\Core\Settings\Concerns;

trait HasFormActivation
{
    protected $formActive = true;

    public function isFormActive()
    {
        return $this->formActive;
    }

    public function disableForm()
    {
        $this->formActive = false;

        return $this;
    }

    public function enableForm()
    {
        $this->formActive = true;

        return $this;
    }
}