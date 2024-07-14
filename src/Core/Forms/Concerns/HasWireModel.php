<?php

namespace Raakkan\Yali\Core\Forms\Concerns;

trait HasWireModel
{
    protected $wireModel;

    public function getWireModel()
    {
        return $this->wireModel;
    }

    public function getWireModelAttribute()
    {
        return 'wire:model=' . $this->getWireModel();
    }

    public function setWireModel($model)
    {
        $this->wireModel = $model;
        return $this;
    }

    public function hasWireModel()
    {
        return !empty($this->wireModel);
    }
}

