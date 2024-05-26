<?php

namespace Raakkan\Yali\Core\Forms\Concerns;

trait HasForm
{
    public $form;

    public function getForm()
    {
        return $this->form;
    }

    public function setForm($form)
    {
        $this->form = $form;
    }
}