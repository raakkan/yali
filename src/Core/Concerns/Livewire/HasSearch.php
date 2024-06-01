<?php

namespace Raakkan\Yali\Core\Concerns\Livewire;

use Illuminate\Contracts\Database\Eloquent\Builder;

trait HasSearch
{
    public $search = '';

    public function clearSearch()
    {
        $this->search = '';
        $this->resetPage();
    }

    public function applySearch(Builder $query, $key)
    {
        if (!empty($this->search) && !empty($key)) {
            $query->where($key, 'like', '%' . $this->search . '%');
        }

        return $query;
    }
}
