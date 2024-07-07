<?php

namespace Raakkan\Yali\Core\Settings\Concerns;

trait HasSettingStoreTypes
{
    protected $storeTypes = [
        'database',
    ];

    public function getStoreTypes()
    {
        return $this->storeTypes;
    }

    public function database($onlyDatabase = false)
    {
        if ($onlyDatabase) {
            $this->storeTypes = ['database'];
        } else {
            $this->mergeStoreTypes(['database']);
        }

        return $this;
    }

    public function session($onlySession = false)
    {
        if ($onlySession) {
            $this->storeTypes = ['session'];
        } else {
            $this->mergeStoreTypes(['session']);
        }
        
        return $this;
    }

    public function mergeStoreTypes(array $storeTypes)
    {
        $this->storeTypes = array_unique(array_merge($this->storeTypes, $storeTypes));

        return $this;
    }

}
