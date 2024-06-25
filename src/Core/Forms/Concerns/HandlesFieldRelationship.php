<?php

namespace Raakkan\Yali\Core\Forms\Concerns;

use Illuminate\Support\Facades\Schema;

trait HandlesFieldRelationship
{
    public $relationshipName;
    public $relationshipClass;
    public $relationshipType;
    public $relationshipValueAttribute;
    public $relationshipLabelAttribute;

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
                
                $field->relationshipValueAttribute = $valueAttribute;
                $field->relationshipLabelAttribute = $labelAttribute;

                $columns = Schema::getColumnListing($modelTable);
                if (!in_array($valueAttribute, $columns) || !in_array($labelAttribute, $columns)) {
                    throw new \Exception("The attributes '{$valueAttribute}' or '{$labelAttribute}' do not exist on {$modelTable}");
                }
                
            } else {
                throw new \Exception('Relationship not found');
            }
            
        });

        return $this;
    }

    public function getRelationshipOptions()
    {
        if ($this->relationshipType === 'BelongsTo') {
            $options = $this->relationshipClass::all()->pluck($this->relationshipLabelAttribute, $this->relationshipValueAttribute);
            // $this->options = $options;

            if ($this->hasLivewire()) {
                return $options;
            }
        }
    }

    public function hasRelationship()
    {
        return method_exists($this->model, $this->relationshipName);
    }
}
