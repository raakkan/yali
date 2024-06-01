<?php

namespace Raakkan\Yali\Core\Concerns\Livewire;

use Illuminate\Contracts\Database\Eloquent\Builder;

trait HasRecords
{
    public function getRecord(Builder $query, $key, $value)
    {
        return $query->where($key, $value)->firstOrFail();
    }
    
    public function getRecords(Builder $query)
    {
        if (method_exists($this, 'hasFilters') && (bool) $this->hasFilters()) {
            $query = $this->applyFilters($query);
         }
 
         if (property_exists($this, 'search') && !empty($this->search)) {
             $query = $this->applySearch($query, 'key');
         }
 
         if (property_exists($this, 'perPage')) {
             $records = $this->applyPagination($query);
         }else{
             $records = $query->get();
         }

        return $records;
    }
}