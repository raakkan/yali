<?php

namespace Raakkan\Yali\Core\Actions\Concerns;

trait HasActions
{
    public $actions = [];

    public $headerActions = [];

    public function actions($actions)
    {
        $this->actions = $actions;
        return $this;
    }

    public function getActions()
    {
        return $this->actions;
    }

    public function headerActions($actions)
    {
        $this->headerActions = $actions;
        return $this;
    }

    public function getHeaderActions()
    {
        return $this->headerActions;
    }
}