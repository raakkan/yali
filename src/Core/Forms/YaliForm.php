<?php 

namespace Raakkan\Yali\Core\Forms;

use Raakkan\Yali\Core\Resources\YaliResource;

class YaliForm
{
    protected $fields = [];

    protected $resource;

    public function __construct(YaliResource $resource)
    {
        $this->resource = $resource;
    }

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
