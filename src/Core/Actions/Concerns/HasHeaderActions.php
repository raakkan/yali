<?php

namespace Raakkan\Yali\Core\Actions\Concerns;

trait HasHeaderActions
{
    public $headerAction = false;

    public function headerAction($headerAction = true)
    {
        $this->headerAction = $headerAction;

        return $this;
    }

    public function isHeaderAction()
    {
        return $this->headerAction;
    }
}
