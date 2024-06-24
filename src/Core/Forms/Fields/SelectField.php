<?php

namespace Raakkan\Yali\Core\Forms\Fields;

use Illuminate\Support\Facades\Schema;

class SelectField extends Field
{
    protected $view = 'yali::forms.fields.select-field';
    protected $options = [];
    public $createNewOption = false;

    // Adding properties to hold relationship details
    public $relationshipName;
    public $relationshipClass;
    public $relationshipType;

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
        
        return $options;
    }

    public function getLivewireOptions()
    {
        if (isset($this->livewire->form[$this->formId]['fields'][$this->getName()]['relationships'][$this->relationshipName])) {
            return $this->livewire->form[$this->formId]['fields'][$this->getName()]['relationships'][$this->relationshipName];
        }else{
            return $this->getOptions();
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

    public function relationship($name, $valueAttribute = 'id', $labelAttribute = 'name')
    {
        $this->beforeRender(function ($field) use ($name, $valueAttribute, $labelAttribute) {
            if (method_exists($field->model, $name)) {
                $relationship = $field->model->{$name}();

                $reflectionClass = new \ReflectionClass($relationship);
                $relationType = $reflectionClass->getShortName();
                $relationshipClass = $relationship->getRelated();
                $modelTable = $relationshipClass->getTable();

                $field->relationshipName = $name;
                $field->relationshipClass = get_class($relationshipClass);
                $field->relationshipType = $relationType;

                $columns = Schema::getColumnListing($modelTable);
                if (!in_array($valueAttribute, $columns) || !in_array($labelAttribute, $columns)) {
                    throw new \Exception("The attributes '{$valueAttribute}' or '{$labelAttribute}' do not exist on {$modelTable}");
                }

                if ($relationType === 'BelongsTo') {
                    $options = $relationshipClass::all()->pluck($labelAttribute, $valueAttribute);
                    $field->options = $options;

                    if ($field->hasLivewire()) {
                        $field->livewire->form[$field->formId]['fields'][$field->getName()]['relationships'][$name] = $options;
                    }
                }
                
            } else {
                throw new \Exception('Relationship not found');
            }
            
        });

        return $this;
    }

}
