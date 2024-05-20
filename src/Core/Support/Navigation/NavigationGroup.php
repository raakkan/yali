<?php

namespace Raakkan\Yali\Core\Support\Navigation;

class NavigationGroup
{
    public $name;
    public $label;
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

}