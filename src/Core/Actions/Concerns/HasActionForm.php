<?php

namespace Raakkan\Yali\Core\Actions\Concerns;

use Raakkan\Yali\Core\Forms\YaliForm;

trait HasActionForm
{
    protected $form;
    
    public function form($form)
    {
        $yaliForm = new YaliForm();
        
        if($this->hasModel()) {
            $yaliForm->setModel($this->getModel());
        }
        
        $formData = null;

        if (is_array($form)) {
            $formData = $form;
        }

        if (is_callable($form)) {
            $formData = call_user_func($form, $yaliForm);
        }

        if (is_null($formData)) {
            return $this;
        }

        if (is_array($formData)) {
            $yaliForm->fields($formData);
        }

        $this->form = $yaliForm;

        return $this;
    }

    public function getForm()
    {
        return $this->form;
    }

    public function hasForm()
    {
        return !is_null($this->form);
    }
}