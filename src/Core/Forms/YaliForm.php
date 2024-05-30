<?php 

namespace Raakkan\Yali\Core\Forms;

use Raakkan\Yali\Core\View\Button;
use Raakkan\Yali\Core\View\YaliComponent;

use Raakkan\Yali\Core\Concerns\UI\Stylable;
use Raakkan\Yali\Core\Concerns\UI\Colorable;
use Raakkan\Yali\Core\Concerns\UI\Spaceable;
use Raakkan\Yali\Core\Concerns\UI\Borderable;
use Raakkan\Yali\Core\Concerns\UI\Layoutable;
use Raakkan\Yali\Core\Resources\YaliResource;
use Raakkan\Yali\Core\Actions\Concerns\Modalable;

class YaliForm extends YaliComponent
{
    use Stylable;
    use Layoutable;
    use Borderable;
    use Colorable;
    use Spaceable;
    use Modalable;

    protected $view = 'yali::forms.form';
    protected $fields = [];
    protected YaliResource $resource;
    protected $submitButton;
    protected $submitButtonLabel = 'Submit';
    protected $formSubmitMethod = 'submit';

    protected $formActionsPostion = 'justify-end';
    protected $extraActionButtons= [];
    

    public function fields($fields)
    {
        $this->fields = $fields;
        return $this;
    }

    public function getFields()
    {
        return $this->fields;
    }

    public function getValidationRules()
    {
        $validationRules = [];

        foreach ($this->fields as $field) {
            $validationRules[$field->getName()] = $field->getValidationRules();
        }

        return $validationRules;
    }

    public function getRounded()
    {
        if ($this->rounded === null) {
            return 'rounded-lg';
        }
        return $this->rounded;
    }

    public function getResource()
    {
        return $this->resource;
    }

    public function setResource(YaliResource $resource)
    {
        $this->resource = $resource;

        return $this;
    }

    public function getSubmitButton()
    {
        if (!$this->submitButton) {
            $this->submitButton = Button::make()
            ->classes(['btn', 'btn-sm'])
            ->submit()
            ->setLabel($this->getSubmitButtonLabel()); 
        }
        return $this->submitButton;
    }

    public function setSubmitButton(Button $button)
    {
        $this->submitButton = $button;
        return $this;
    }

    public function getSubmitButtonLabel()
    {
        return $this->submitButtonLabel;
    }

    public function setSubmitButtonLabel($label)
    {
        $this->submitButtonLabel = $label;
        return $this;
    }

    public function getFormSubmitMethod()
    {
        return $this->formSubmitMethod;
    }

    public function setFormSubmitMethod($method)
    {
        $this->formSubmitMethod = $method;
        return $this;
    }

    public function getFormActionsPosition()
    {
        return $this->formActionsPostion;
    }

    public function formActionsPosition($position)
    {
        if ($position instanceof \BackedEnum) {
            $position = $position->value;
        }

        if (strpos($position, 'justify-') !== false) {
            $this->formActionsPostion = $position;
        } elseif ($position === 'left' || $position === 'right') {
            $this->formActionsPostion = $position === 'left' ? 'justify-start' : 'justify-end';
        } elseif ($position === 'end' || $position === 'start') {
            $this->formActionsPostion = $position === 'end' ? 'justify-end' : 'justify-start';
        } else {
            $this->formActionsPostion = 'justify-end';
        }

        return $this;
    }

    public function getExtraActionButtons()
    {
        return $this->extraActionButtons;
    }

    public function extraActionButtons(Button ...$buttons)
    {
        $this->extraActionButtons = $buttons;
        return $this;
    }

}
