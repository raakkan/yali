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
                if (!$action->isHeaderAction()) {
                    $actions[get_class($action)] = $action->setSource($this->getSource());
                }
            }
        }
        return $actions;
    }

    public function getHeaderActions()
    {
        $actions = [];
        foreach ($this->actions as $action) {
            if (is_subclass_of($action, YaliAction::class)) {
                if ($action->isHeaderAction()) {
                    $actions[get_class($action)] = $action->setSource($this->getSource());
                }
            }
        }
        return $actions;
    }

    public function hasActions()
    {
        return count($this->getActions()) > 0;
    }

    public function setActionModel($actionClass ,$model)
    {
        $action = $this->getAction($actionClass);

        $action->setModel($model);

        $this->setAction($actionClass, $action);

        return $this;
    }

    public function getAction($class)
    {
        $action = $this->getActions()[$class] ?? null;
        if (!$action) {
            $action = $this->getHeaderActions()[$class] ?? null;
        }
        return $action;
    }

    public function setAction($actionClass, $action)
    {
        $this->actions[$actionClass] = $action;
        return $this;
    }

}