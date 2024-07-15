<?php

namespace Raakkan\Yali\Core\Settings\Concerns;

trait Lockable
{
    protected $lock = false;

    public function lock($lock = true)
    {
        $this->lock = $lock;

        return $this;
    }

    public function isLocked()
    {
        return $this->lock;
    }

    public function isNotLocked()
    {
        return ! $this->lock;
    }

    public function disableLock()
    {
        $this->lock = false;

        return $this;
    }
}
