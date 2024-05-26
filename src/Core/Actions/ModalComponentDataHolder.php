<?php

namespace Raakkan\Yali\Core\Actions;

class ModalComponentDataHolder
{
    public $data = [];

    public function add($key, $value)
    {
        $this->data[$key] = $value;
    }

    public function get($key)
    {
        return $this->data[$key] ?? null;
    }
}
