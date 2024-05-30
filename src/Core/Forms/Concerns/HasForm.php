<?php

namespace Raakkan\Yali\Core\Forms\Concerns;

use Raakkan\Yali\Core\Forms\YaliForm;

trait HasForm
{
    protected $form;

    protected static $submitLabel;
   
    abstract public function form(YaliForm $form): YaliForm;

    public function getForm()
    {
        if(!$this->form) {
            $this->form = new YaliForm();
            if(static::getSubmitLabel()) {
                $this->form->setSubmitButtonLabel(static::getSubmitLabel());
            }
        }

        return $this->form;
    }

    public function setForm(YaliForm $form)
    {
        $this->form = $form;
        return $this;
    }

    public function getSubmitLabel()
    {
        return static::$submitLabel;
    }
}