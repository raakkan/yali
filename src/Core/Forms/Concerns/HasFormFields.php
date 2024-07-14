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
        $fields = [];

        foreach ($this->fields as $field) {
            if ($this->hasModel()) {
                $fields[] = $field->setModel($this->getModel())->setLivewire($this->livewire)->setWireModel($this->getWireModel().'.inputs.'.$field->getName());
            } else {
                $fields[] = $field->setLivewire($this->livewire)->setWireModel($this->getWireModel().'.inputs.'.$field->getName());
            }
        }

        return $fields;
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

    public function setFieldValue($name, $value)
    {
        foreach ($this->fields as $index => $field) {
            if ($field->getName() == $name) {
                $field->value($value);
                $this->fields[$index] = $field;
            }
        }

        return $this;
    }

    public function setOldFieldValue($name, $value)
    {
        foreach ($this->fields as $index => $field) {
            if ($field->getName() == $name) {
                $field->setOldValue($value);
                $this->fields[$index] = $field;
            }
        }

        return $this;
    }

    public function getFieldValue($name)
    {
        foreach ($this->fields as $field) {
            if ($field->getName() == $name) {
                return $field->getValue();
            }
        }
    }

    public function getFieldByName($name)
    {
        foreach ($this->fields as $field) {
            if ($field->getName() == $name) {
                return $field;
            }
        }
    }

    public function getField($name)
    {
        if ($this->hasField($name)) {
            return $this->getFieldByName($name);
        }else{
            return null;
        }
    }

    public function hasField($name)
    {
        foreach ($this->fields as $field) {
            if ($field->getName() == $name) {
                return true;
            }
        }
    }

}
