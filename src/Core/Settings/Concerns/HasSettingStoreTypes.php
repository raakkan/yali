<?php

namespace Raakkan\Yali\Core\Settings\Concerns;

trait HasSettingStoreTypes
{
    protected $storeType = 'database';

    public function getStoreType()
    {
        return $this->storeTypes;
    }

    public function database()
    {
        $this->storeType = 'database';
        return $this;
    }

    public function session()
    {
        $this->storeType = 'session';
        return $this;
    }

    public function isStoreTypeDatabase()
    {
        return $this->storeType === 'database';
    }

}
