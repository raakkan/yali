<?php

namespace Raakkan\Yali\Core\Settings\Concerns;

trait HasSettingFieldId
{
    protected $id;

    public function generateId()
    {
        $this->id = $this->source.'.'.$this->group.'.'.$this->name;
    }

    public function getId()
    {
        return $this->id;
    }
}
