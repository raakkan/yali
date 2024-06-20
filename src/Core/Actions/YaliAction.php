<?php

namespace Raakkan\Yali\Core\Actions;
use Raakkan\Yali\Core\Forms\YaliForm;
use Raakkan\Yali\Core\Concerns\Makable;
use Raakkan\Yali\Core\View\YaliComponent;
use Raakkan\Yali\Core\Concerns\UI\Stylable;
use Raakkan\Yali\Core\Actions\Concerns\HasLink;
use Raakkan\Yali\Core\Actions\Concerns\HasLabel;
use Raakkan\Yali\Core\Actions\Concerns\HasSource;
use Raakkan\Yali\Core\Actions\Concerns\HasWizard;
use Raakkan\Yali\Core\Actions\Concerns\Modalable;
use Raakkan\Yali\Core\Concerns\Database\HasModel;
use Raakkan\Yali\Core\Concerns\Components\HasButton;
use Raakkan\Yali\Core\Actions\Concerns\HasHeaderActions;
use Raakkan\Yali\Core\Actions\Concerns\ModalConfirmation;

abstract class YaliAction extends YaliComponent
{
    use Makable;
    use Stylable;
    use Modalable;
    use HasLabel;
    use HasLink;
    use HasButton;
    use HasModel;
    use HasHeaderActions;
    use HasSource;
    use HasWizard;
    use ModalConfirmation;

    protected $componentName = 'action';

    protected $view = 'yali::actions.action';

    protected $action;
    protected $form;

    public function buttonAttributes()
    {
        return [
            'wire:key' => 'action-button-'. $this->getUniqueKey(),
        ];
    }

    public function execute()
    {
        if (is_callable($this->action)) {
            if ($this->hasForm()) {
                return call_user_func($this->action, $this->getModel(), $this->getForm());
            } else {
                return call_user_func($this->action, $this->getModel());
            }
        }
    }

    public function action($action = null)
    {
        if (is_callable($action)) {
            $this->action = $action;
        }

        return $this;
    }

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
