<?php

namespace Raakkan\Yali\Core\Forms\Concerns;

use Raakkan\Yali\Core\Forms\YaliForm;

trait HasForm
{
    protected $form;
   
    abstract public function form(YaliForm $form): YaliForm;

    public function getForm()
    {
        if(!$this->form) {
            $this->form = new YaliForm();
        }
        return $this->form;
    }
}