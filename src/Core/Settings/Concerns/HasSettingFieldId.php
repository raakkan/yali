<?php

namespace Raakkan\Yali\Core\Settings\Concerns;

trait HasSettingFieldId
{
    protected $id;
    
    public function generateId()
    {
        $this->id = $this->source . '.' . $this->name;

        if ($this->hasGroup()) {
            $this->id = $this->source . '.' . $this->group . '.' . $this->id;
        }
    }

    public function getId()
    {
        return $this->id;
    }
}