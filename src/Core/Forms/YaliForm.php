<?php 

namespace Raakkan\Yali\Core\Forms;

use Raakkan\Yali\Core\Concerns\Stylable;
use Raakkan\Yali\Core\View\YaliComponent;

class YaliForm extends YaliComponent
{
    use Stylable;

    protected $view = 'yali::forms.form';
    protected $fields = [];

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
}
