<?php

namespace Raakkan\Yali\Core\Actions;
use Illuminate\Support\Facades\Log;
use Raakkan\Yali\Core\Resources\YaliResource;
use Raakkan\Yali\Core\Traits\Makable;
use Illuminate\Database\Eloquent\Model;
use Raakkan\Yali\Core\View\YaliComponent;
use Raakkan\Yali\Core\Resources\Table\YaliTable;

abstract class YaliAction extends YaliComponent
{
    use Makable;

    protected string $label;
    protected bool $isLink = false;
    protected string $route;
    protected Model $model;

    protected YaliResource $resource;

    public function label($label)
    {
        $this->label = $label;

        return $this;
    }
    
    public function getLabel()
    {
        return $this->label ?? 'Action';
    }

    public function getModel()
    {
        return $this->model;
    }

    public function setModel(Model $model)
    {
        $this->model = $model;

        return $this;
    }

    public function getResource()
    {
        return $this->resource;
    }

    public function setResource(YaliResource $resource)
    {
        $this->resource = $resource;

        return $this;
    }

    public function link($route)
    {
        $this->route = $route;

        $this->isLink = true;

        return $this;
    }

    public function isLink()
    {
        return $this->isLink;
    }

    public function getRoute()
    {
        return $this->route;
    }
}
