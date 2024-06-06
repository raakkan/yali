<?php

namespace Raakkan\Yali\Core\Actions\Concerns;

use Raakkan\Yali\Core\Actions\YaliAction;

trait HasActions
{
    public $actions = [];

    public function actions($actions)
    {
        $this->actions = $actions;
        return $this;
    }

    public function getActions()
    {
        $actions = [];
        foreach ($this->actions as $action) {
            if (is_subclass_of($action, YaliAction::class)) {
                $actions[get_class($action)] = $action;
            }
        }
        return $actions;
    }

    public function hasActions()
    {
        return count($this->getActions()) > 0;
    }
}