<?php

namespace Raakkan\Yali\Core\Forms\Fields;

use Illuminate\Support\Js;

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
        $options = [];
        
        if (is_callable($this->options)) {
            $options = call_user_func($this->options);
        } else {
            $options = $this->options;
        }
        
        $newOptions = [];
        foreach ($options as $key => $option) {
            $newOptions[] = [
                'value' => $key,
                'label'=> $option
            ];
        }
        
        return $newOptions;
    }

    public function getJsOptions()
    {
        return Js::from($this->getOptions())->toHtml();
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

   public function relationship($name)
    {
        $this->beforeRender(function ($field) use ($name) {
            if (method_exists($field->model, $name)) {
                $relationship = $field->model->{$name}();

                $relationType = (new \ReflectionClass($relationship))->getShortName();
                $relationshipClass = $relationship->getRelated();

                $field->options = $relationshipClass::all()->pluck('name', 'id');
            } else {
                throw new \Exception('Relationship not found');
            }
            
        });

        return $this;
    }

}
