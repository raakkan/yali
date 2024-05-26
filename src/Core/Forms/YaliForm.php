<?php 

namespace Raakkan\Yali\Core\Forms;

class YaliForm
{
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
