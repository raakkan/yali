<?php 

namespace Raakkan\Yali\Core\Support\Navigation;

use Illuminate\Contracts\Support\Renderable;

class Navigation implements Renderable
{
    protected $items = [];

    public function add($item)
    {
        $this->items[] = $item;
    }

    public function findGroup($group)
    {
        foreach ($this->items as $item) {
            if ($item instanceof NavigationGroup && $item->getName() === $group) {
                return $item;
            }
        }

        return null;
    }

    public function hasSlug($slug)
    {
        foreach ($this->items as $item) {
            if ($item instanceof NavigationItem && $item->getSlug() === $slug) {
                return true;
            } elseif ($item instanceof NavigationGroup) {
                foreach ($item->getItems() as $groupItem) {
                    if ($groupItem->getSlug() === $slug) {
                        return true;
                    }
                }
            }
        }

        return false;
    }

    public function getItems()
    {
        return $this->items;
    }

    public function render()
    {
        return view('yali::navigation.navigation', [
            'items' => $this->getItems(),
        ]);
    }

}