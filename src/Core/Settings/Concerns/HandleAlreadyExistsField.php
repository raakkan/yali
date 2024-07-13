<?php

namespace Raakkan\Yali\Core\Settings\Concerns;

trait HandleAlreadyExistsField
{
    protected $alreadyExists = false;
    protected $alreadyExistedField;
    
    public function isAlreadyExists()
    {
        return $this->alreadyExists;
    }

    public function getAlreadyExistedField()
    {
        return $this->alreadyExistedField;
    }

    public function setAlreadyExistedField($alreadyExistedField)
    {
        $this->alreadyExists = true;
        $this->alreadyExistedField = $alreadyExistedField;

        return $this;
    }
}