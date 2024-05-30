<?php 

namespace Raakkan\Yali\Core\Actions\Concerns;

trait HasLink
{
    protected bool $isLink = false;
    protected string $route;

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

    public function setLink($link = true)
    {
        $this->isLink = $link;
        return $this;
    }

    public function getRoute()
    {
        return $this->route;
    }
}
