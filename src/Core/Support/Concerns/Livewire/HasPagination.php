<?php

namespace Raakkan\Yali\Core\Support\Concerns\Livewire;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Livewire\Attributes\On;

trait HasPagination
{
    public $perPage = 10;

    #[On('refresh-page')]
    public function refreshPage()
    {
        $this->resetPage();
    }

    public function applyPagination(Builder $query)
    {
        return $query->paginate($this->perPage);
    }

    public function setPerPage($perPage)
    {
        $this->perPage = $perPage;

        return $this;
    }
}
