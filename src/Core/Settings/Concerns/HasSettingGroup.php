<?php

namespace Raakkan\Yali\Core\Settings\Concerns;

trait HasSettingGroup
{
    protected $group = 'default';

    public function group($group = null)
    {
        $this->group = $group;
        return $this;
    }

    public function getGroup()
    {
        return $this->group;
    }

    public function setGroup($group)
    {
        $this->group = $group;
        return $this;
    }

    public function unsetGroup()
    {
        $this->group = null;
        return $this;
    }

    public function hasGroup()
    {
        return $this->group !== null;
    }
}