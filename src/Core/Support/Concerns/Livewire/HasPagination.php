<?php

namespace Raakkan\Yali\Core\Support\Concerns\Livewire;

use Livewire\Attributes\On;
use Illuminate\Support\Facades\Log;
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

    public function setPerPage($perPage)
    {
        $this->perPage = $perPage;
        return $this;
    }
}
