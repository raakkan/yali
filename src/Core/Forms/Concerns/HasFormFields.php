<?php

namespace Raakkan\Yali\Core\Forms\Concerns;

trait HasFormFields
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

    public function getValidationMessages()
    {
        $validationMessages = [];

        foreach ($this->fields as $field) {
            $fieldValidationMessages = $field->getValidationMessages();
            
            foreach ($fieldValidationMessages as $key => $message) {
                $validationMessages[$field->getName() . '.' . $key] = $message;
            }
        }

        return $validationMessages;
    }

    public function getValidationAttributes()
    {
        $validationAttributes = [];

        foreach ($this->fields as $field) {
            $validationAttributes[$field->getName()] = $field->getLabel();
        }

        return $validationAttributes;
    }

}
