<?php 

namespace Raakkan\Yali\Core\Support\Navigation;

class NavigationItem
{
    public $label;
    public $slug;
    public $icon;
    public $order;
    public $children;

    public function __construct($label, $slug, $icon = null, $order = 0)
    {
        $this->label = $label;
        $this->slug = $slug;
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
}
