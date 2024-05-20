<?php

namespace Raakkan\Yali\Core\Support\Navigation;

class NavigationGroup
{
    public $name;
    public $label;
    public $items = [];

    public function __construct($name, $label)
    {
        $this->name = $name;
        $this->label = $label;
    }

    public function addItem(NavigationItem $item)
    {
        $this->items[] = $item;
        usort($this->items, function ($a, $b) {
            return $a->order - $b->order;
        });
    }
}