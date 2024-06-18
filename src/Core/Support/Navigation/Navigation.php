<?php 

namespace Raakkan\Yali\Core\Support\Navigation;

use Illuminate\Contracts\Support\Renderable;

class Navigation implements Renderable
{
    protected $items = [];

    public function add($item)
    {
        $this->items[$item->getClass()] = $item;
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
        $items = [];

        foreach ($this->items as $item) {
            if ($item instanceof NavigationGroup) {
                $groupItems = $item->getItems();
                $groupItems = $this->sortItems($groupItems);
                $item->setItems($groupItems);
                $items[] = $item;
            } else {
                $items[] = $item;
            }
        }

        $items = $this->sortItems($items);

        return $items;
    }

    public function getAllItems()
    {
        $items = collect($this->items);
    
        $groupItems = $items->filter(function ($item) {
            return $item instanceof NavigationGroup;
        })->flatMap(function ($group) {
            return $group->getItems();
        });
    
        $navigationItems = $items->filter(function ($item) {
            return $item instanceof NavigationItem;
        });
    
        return $navigationItems->merge($groupItems);
    }

    public function sortItems($items)
    {
        usort($items, function ($a, $b) {
            return $a->order - $b->order;
        });
        return $items;
    }

    public function render()
    {
        return view('yali::navigation.navigation', [
            'items' => $this->getItems()
        ]);
    }

    public function findBySlug($slug)
    {
        foreach ($this->items as $item) {
            if ($item instanceof NavigationItem && $item->getSlug() === $slug) {
                return $item;
            } elseif ($item instanceof NavigationGroup) {
                foreach ($item->getItems() as $groupItem) {
                    if ($groupItem->getSlug() === $slug) {
                        return $groupItem;
                    }
                }
            }
        }
    }

}