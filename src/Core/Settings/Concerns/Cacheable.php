<?php

namespace Raakkan\Yali\Core\Settings\Concerns;

trait Cacheable
{
    protected $cache = true;

    public function cache($cache = true)
    {
        $this->cache = $cache;

        return $this;
    }

    public function disableCache()
    {
        $this->cache = false;

        return $this;
    }

    public function enableCache()
    {
        $this->cache = true;

        return $this;
    }

    public function isCacheDisabled()
    {
        return !$this->cache;
    }

    public function isCacheEnabled()
    {
        return $this->cache;
    }
}