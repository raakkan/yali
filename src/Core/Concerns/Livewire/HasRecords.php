<?php

namespace Raakkan\Yali\Core\Concerns\Livewire;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Database\Eloquent\Builder;

trait HasRecords
{
    public function getRecord(Builder $query, $key, $value)
    {
        $model = $query->getModel();

        if ($this->modelSupportsSoftDeletes($model)) {
            $query->withTrashed();
        }

        return $query->where($key, $value)->firstOrFail();
    }
    
    public function getRecords(Builder $query)
    {
        $model = $query->getModel();

        if ($this->modelSupportsSoftDeletes($model)) {
            $query->withTrashed();
        }
        
        if (method_exists($this, 'hasFilters') && (bool) $this->hasFilters()) {
            $query = $this->applyFilters($query);
         }
 
         if (property_exists($this, 'search') && !empty($this->search)) {
             $query = $this->applySearch($query);
         }
 
         if (property_exists($this, 'perPage')) {
             $records = $this->applyPagination($query);
         }else{
             $records = $query->get();
         }

        return $records;
    }

    protected function modelSupportsSoftDeletes(Model $model)
    {
        return in_array(SoftDeletes::class, class_uses_recursive($model));
    }
}