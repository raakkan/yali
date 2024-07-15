<?php

namespace Raakkan\Yali\Core\Support\Concerns\Livewire;

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

    public function hasLivewire()
    {
        return isset($this->livewire) && ! empty($this->livewire) && $this->livewire !== null;
    }

    public function getLivewireId()
    {
        return $this->livewire->getId();
    }
}
