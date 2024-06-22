<?php

namespace Raakkan\Yali\Core\Concerns\Livewire;

trait HasLivewire
{
    public $livewire;

    public function setLivewire($livewire)
    {
        $this->livewire = $livewire;
        return $this;
    }

    public function getLivewire()
    {
        return $this->livewire;
    }
}