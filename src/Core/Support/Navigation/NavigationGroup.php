<?php

namespace Raakkan\Yali\Core\Support\Navigation;

class NavigationGroup
{
    public $name;
    public $label;
    public $icon;
    public $order;
    public $items = [];

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function addItem(NavigationItem $item)
    {
        $this->items[] = $item;
        usort($this->items, function ($a, $b) {
            return $a->order - $b->order;
        });
    }

    public function getName()
    {
        return $this->name;
    }

    public function getItems()
    {
        return $this->items;
    }

    public function setItems($items)
    {
        $this->items = $items;
    }

    public function setIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    public function getIcon()
    {
        return $this->icon;
    }

    public function hasActiveRoute()
    {
        foreach ($this->items as $item) {
            if ($item instanceof NavigationItem && $item->isActive()) {
                return true;
            }
        }

        return false;
    }

}