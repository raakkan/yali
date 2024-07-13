<?php

namespace Raakkan\Yali\Core\Support\Navigation;

use Raakkan\Yali\Core\Support\Concerns\Makable;


class NavigationGroup
{
    use Makable;

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

        return $this;
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

        return $this;
    }

    public function mergeItems($items)
    {
        $this->items = array_merge($this->items, $items);

        usort($this->items, function ($a, $b) {
            return $a->order - $b->order;
        });

        return $this;
    }

    public function setIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    public function hasIcon()
    {
        return isset($this->icon) && $this->icon !== null && $this->icon !== '';
    }

    public function getIcon()
    {
        return $this->icon;
    }

    public function hasActiveRoute()
    {
        foreach ($this->items as $item) {
            if ($item->isActive()) {
                return true;
            }
        }

        return false;
    }

    public function isHidden()
    {
        return false;
    }

    public function setOrder($order)
    {
        $this->order = $order;

        return $this;
    }

}