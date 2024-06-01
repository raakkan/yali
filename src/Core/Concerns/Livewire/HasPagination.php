<?php

namespace Raakkan\Yali\Core\Concerns\Livewire;

use Livewire\Attributes\On;
use Illuminate\Contracts\Database\Eloquent\Builder;

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
}
