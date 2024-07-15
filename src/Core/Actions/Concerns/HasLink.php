<?php

namespace Raakkan\Yali\Core\Actions\Concerns;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

trait HasLink
{
    protected string $route;

    protected array $routeParameters = [];

    public function link($route, $parameters = [])
    {
        if ($this->isValidRoute($route) || $this->isValidLink($route)) {
            $this->route = $route;
            $this->routeParameters = $parameters;
            $this->buttonIsLink = true;

            return $this;
        }

        throw new \InvalidArgumentException('Invalid route or link provided.');
    }

    public function getRoute()
    {
        if (isset($this->route) && $this->isValidRoute($this->route)) {
            return route($this->route, $this->routeParameters);
        }

        if (isset($this->route) && $this->isValidLink($this->route)) {
            return $this->route;
        }

        return null;
    }

    public function getRouteParameters()
    {
        return $this->routeParameters;
    }

    public function setRouteParameters($parameters)
    {
        $this->routeParameters = $parameters;

        return $this;
    }

    public function route($route, $parameters = [])
    {
        if ($this->isValidRoute($route)) {
            $this->route = $route;
            $this->routeParameters = $parameters;

            return $this;
        }

        throw new \InvalidArgumentException('Invalid route provided.');
    }

    protected function isValidRoute($route)
    {
        return Route::has($route);
    }

    protected function isValidLink($link)
    {
        return Str::startsWith($link, ['http://', 'https://']);
    }
}
