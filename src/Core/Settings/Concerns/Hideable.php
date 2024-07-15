<?php

namespace Raakkan\Yali\Core\Settings\Concerns;

trait Hideable
{
    protected $hide = false;

    public function hide($hide = true)
    {
        $this->hide = $hide;

        return $this;
    }

    public function isHidden()
    {
        return $this->hide;
    }

    public function isNotHidden()
    {
        return ! $this->hide;
    }

    public function disableHide()
    {
        $this->hide = false;

        return $this;
    }
}
