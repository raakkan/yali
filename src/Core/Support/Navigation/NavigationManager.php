<?php

namespace Raakkan\Yali\Core\Support\Navigation;

use Illuminate\Support\Str;
use Raakkan\Yali\App\DashboardPage;
use Raakkan\Yali\Core\Utils\RouteUtils;

class NavigationManager
{
    protected $navigation;

    public function __construct()
    {
        $this->navigation = new Navigation();
    }

    public function build($pages)
    {
        $this->navigation->add(
            new NavigationItem(
                'Dashboard',
                '/',
                'yali::pages.dashboard',
                DashboardPage::class,
                'page',
                'dashboard',
                0,
                '/admin'
            )
        );

        foreach ($pages as $key => $value) {
            $group = $value['class']::getNavigationGroup();

            if ($group) {
                $groupItem = $this->findOrCreateGroup($group, $value['class']::getNavigationGroupIcon());
                $groupItem->addItem($this->createNavigationItem($value));
            } else {
                $this->navigation->add($this->createNavigationItem($value));
            }
        }
    }

    protected function findOrCreateGroup($group, $icon = null)
    {
        $groupItem = $this->navigation->findGroup($group);

        if ($groupItem) {
            if ($icon) {
                $groupItem->setIcon($icon);
            }
            
            return $groupItem;
        }

        $groupItem = new NavigationGroup($group);

        if ($icon) {
            $groupItem->setIcon($icon);
        }

        $this->navigation->add($groupItem);

        return $groupItem;
    }

    public function createNavigationItem($data)
    {
        $slug = $data['class']::getSlug();
        $uniqueSlug = $this->generateUniqueSlug($slug);

        return new NavigationItem(
            $data['class']::getNavigationLabel(),
            $uniqueSlug,
            RouteUtils::getRouteNameByClass($data['class']),
            $data['class'],
            $data['class']::getType(),
            $data['class']::getNavigationIcon(),
            $data['class']::getNavigationOrder(),
            '/admin/'.$uniqueSlug
        );
    }

    protected function generateUniqueSlug($slug)
    {
        $originalSlug = $slug;
        $counter = 1;

        while ($this->navigation->hasSlug($slug)) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    public function getNavigation()
    {
        return $this->navigation;
    }

    public function findBySlug($slug)
    {
        if ($slug === 'admin') {
            return $this->navigation->findBySlug('/');
        } else {
            return $this->navigation->findBySlug($slug);
        }
        
    }

}
