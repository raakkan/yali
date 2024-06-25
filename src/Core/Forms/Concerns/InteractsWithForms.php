<?php

namespace Raakkan\Yali\Core\Forms\Concerns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

trait InteractsWithForms
{
    public Model $model;

    public $form = [];

    public function fillForm()
    {
        foreach ($this->getForm()->getFields() as $field) {
            if ($field->getType() !== 'password') {
                $this->form[$this->getForm()->getId()]['inputs'][$field->getName()] = $this->model->{$field->getName()} ?? $field->getDefault();
            }
            if ($field->getType() === 'password') {
                $this->form[$this->getForm()->getId()]['inputs'][$field->getName()] = '';
            }
        }
    }

    // TODO: display unchanged message
    public function validatedInputs()
    {
        $rules = $this->getValidationRules();
        // change to primary key
        if ($this->model->id) {
            foreach ($this->getForm()->getFields() as $field) {
                if ($field->getType() === 'password') {
                    if (empty($this->form[$this->getForm()->getId()]['inputs'][$field->getName()])) {

                        // check not correct
                        if (array_key_exists($field->getName(), $rules)) {
                            foreach ($rules[$field->getName()] as $key => $rule) {
                                if (is_string($rule) && Str::contains($rule, 'confirmed')) {
                                    $confirmationFieldName = explode(':', $rule)[1];
                                    unset($rules[$confirmationFieldName]);
                                }
                            }
                        }

                        unset($rules[$field->getName()]);
                    }
                }
            }
        }
        
        $validated = Validator::make(
            $this->form[$this->getForm()->getId()]['inputs'],
            $rules,
            $this->getForm()->getValidationMessages()
         )->validate();

        return $validated;
    }

    public function getValidationRules()
    {
        return $this->getForm()->getValidationRules();
    }
}