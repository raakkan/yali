<?php

namespace Raakkan\Yali\Core\Forms\Fields;

class SelectField extends Field
{
    protected $view = 'yali::forms.fields.select-field';
    protected $options = [];
    public $createNewOption = false;

    public function options($options)
    {
        if (!is_array($options) && !is_callable($options)) {
            throw new \InvalidArgumentException('Options must be an array or a callable');
        }

        $this->options = $options;
        return $this;
    }

    public function getOptions()
    {
        if ($this->hasRelationship()) {
            // return $this->livewire->form[$this->formId]['fields'][$this->getName()]['relationships'][$this->relationshipName];
            return $this->getRelationshipOptions();
        }else{
            $options = [];
            
            if (is_callable($this->options)) {
                $options = call_user_func($this->options);
            } else {
                $options = $this->options;
            }
            
            return $options;
        }
    }

    public function createNewOption()
    {
        $this->createNewOption = true;
        return $this;
    }

    public function isCreateNewOption()
    {
        return $this->createNewOption;
    }

}
