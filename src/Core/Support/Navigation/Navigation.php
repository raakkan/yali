<?php

namespace Raakkan\Yali\Core\Support\Navigation;

use Illuminate\Contracts\Support\Renderable;

class Navigation implements Renderable
{
    protected $items = [];

    public function add($item)
    {
        if ($item instanceof NavigationItem) {
            $slug = $item->getSlug();
            $uniqueSlug = $this->generateUniqueSlug($slug);
            $item->setSlug($uniqueSlug);
            $this->items[$item->getClass()] = $item;
        } else {
            $group = $this->findGroup($item);
            $this->items[$group->getName()] = $group;
        }
    }

    public function findGroup(NavigationGroup $group)
    {
        foreach ($this->items as $item) {
            if ($item instanceof NavigationGroup && $item->getName() === $group->getName()) {
                $groupItems = $group->getItems();
                $uniqueGroupItems = [];

                foreach ($groupItems as $groupItem) {
                    $slug = $groupItem->getSlug();
                    $uniqueSlug = $this->generateUniqueSlug($slug);
                    $groupItem->setSlug($uniqueSlug);
                    $uniqueGroupItems[] = $groupItem;
                }

                $item->mergeItems($uniqueGroupItems);
                $item->setOrder($group->order);

                if ($group->hasIcon()) {
                    $item->setIcon($group->icon);
                }

                return $item;
            }
        }

        $groupItems = $group->getItems();
        $uniqueGroupItems = [];

        foreach ($groupItems as $groupItem) {
            $slug = $groupItem->getSlug();
            $uniqueSlug = $this->generateUniqueSlug($slug);
            $groupItem->setSlug($uniqueSlug);
            $uniqueGroupItems[] = $groupItem;
        }

        $group->setItems($uniqueGroupItems);

        return $group;
    }

    public function generateUniqueSlug($slug)
    {
        $originalSlug = $slug;
        $counter = 1;

        while ($this->hasSlug($slug)) {
            $slug = $originalSlug.'-'.$counter;
            $counter++;
        }

        return $slug;
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

        $items = collect($items)->filter(function ($item) {
            return ! $item->isHidden();
        })->toArray();

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
            'items' => $this->getItems(),
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
