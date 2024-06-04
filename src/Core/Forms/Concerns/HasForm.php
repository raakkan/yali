<?php

namespace Raakkan\Yali\Core\Forms\Concerns;

use Raakkan\Yali\Core\Forms\YaliForm;

trait HasForm
{
    protected $form;
   
    public function form(YaliForm $form): YaliForm
    {
        return $form;
    }

    public function getForm()
    {
        if(!$this->form) {
            $this->form = new YaliForm();
        }

        return $this->form;
    }
}