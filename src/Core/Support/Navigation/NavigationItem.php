<?php 

namespace Raakkan\Yali\Core\Support\Navigation;

class NavigationItem
{
    public $title;
    public $url;
    public $icon;
    public $order;
    public $children;

    public function __construct($title, $url, $icon = null, $order = 0, $children = [])
    {
        $this->title = $title;
        $this->url = $url;
        $this->icon = $icon;
        $this->order = $order;
        $this->children = $children;
    }

    public function addChild(NavigationItem $menuItem)
    {
        $this->children[] = $menuItem;
        usort($this->children, function ($a, $b) {
            return $a->order - $b->order;
        });
    }
}
