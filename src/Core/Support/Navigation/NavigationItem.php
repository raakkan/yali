<?php 

namespace Raakkan\Yali\Core\Support\Navigation;

class NavigationItem
{
    public $label;
    public $slug;
    public $routeName;
    public $icon;
    public $order;
    public $children;
    public $class;

    public function __construct($label, $slug, $routeName, $class, $icon = null, $order = 0)
    {
        $this->label = $label;
        $this->slug = $slug;
        $this->routeName = $routeName;
        $this->class = $class;
        $this->icon = $icon;
        $this->order = $order;
    }

    // public function addChild(NavigationItem $menuItem)
    // {
    //     $this->children[] = $menuItem;
    //     usort($this->children, function ($a, $b) {
    //         return $a->order - $b->order;
    //     });
    // }

    public function getSlug()
    {
        return $this->slug;
    }

    public function isActive()
    {
        return true;
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
}
