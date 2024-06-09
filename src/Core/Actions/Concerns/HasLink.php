<?php 

namespace Raakkan\Yali\Core\Actions\Concerns;

trait HasLink
{
    protected bool $isLink = false;
    protected string $route;

    protected string $routeParam;

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

    public function getRouteParam()
    {
        return $this->routeParam;
    }

    public function setRouteParam($routeParam)
    {
        $this->routeParam = $routeParam;
        return $this;
    }

    public function hasRouteParam()
    {
        return isset($this->routeParam);
    }
}
