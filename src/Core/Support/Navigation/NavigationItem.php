<?php 

namespace Raakkan\Yali\Core\Support\Navigation;

class NavigationItem
{
    public $label;
    public $slug;
    public $routeName;
    public $class;
    public $type;
    public $icon;
    public $order;
    public $path;
    public $childrens;
    public $parent;

    public function __construct($label, $slug, $routeName, $class, $type, $icon = null, $order = 0, $path = null, $parent = null)
    {
        $this->label = $label;
        $this->slug = $slug;
        $this->routeName = $routeName;
        $this->class = $class;
        $this->type = $type;
        $this->icon = $icon;
        $this->order = $order;
        $this->path = $path;
        $this->parent = $parent;
    }

    public function addChild(NavigationItem $menuItem)
    {
        $this->childrens[] = $menuItem;
        $menuItem->setParent($this);
    }

    public function setParent(NavigationItem $parent)
    {
        $this->parent = $parent;
    }

    public function getParent()
    {
        return $this->parent;
    }

    public function hasParent()
    {
        return $this->parent !== null;
    }

    public function getChildrens()
    {
        return $this->childrens;
    }

    public function hasChildrens()
    {
        return $this->childrens !== null;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function isActive()
    {
        return request()->routeIs($this->routeName);
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function getRouteName()
    {
        return $this->routeName;
    }

    public function getClass()
    {
        return $this->class;
    }

    public function getOrder()
    {
        return $this->order;
    }

    public function getIcon()
    {
        return $this->icon;
    }

    public function getType()
    {
        return $this->type;
    }
}
