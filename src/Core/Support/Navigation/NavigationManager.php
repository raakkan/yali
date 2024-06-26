<?php

namespace Raakkan\Yali\Core\Support\Navigation;

use Illuminate\Support\Str;
use Raakkan\Yali\App\DashboardPage;
use Raakkan\Yali\App\LanguagesPage;
use Raakkan\Yali\App\HandleResourcePage;
use Raakkan\Yali\Core\FileManager\FileManagerPage;

class NavigationManager
{
    protected $navigation;

    public function __construct()
    {
        $this->navigation = new Navigation();
    }

    public function build($pages)
    {
        $this->navigation->add(DashboardPage::createNavigationItem());
        $this->navigation->add(LanguagesPage::createNavigationItem());
        $this->navigation->add(FileManagerPage::createNavigationItem());

        // TODO: navigation slug uniqueness check
        foreach ($pages as $value) {
            // $group = $value['class']::getNavigationGroup();

            // if ($group) {
            //     $groupItem = $this->findOrCreateGroup($group, $value['class']::getNavigationGroupIcon());
            //     $groupItem->addItem($value['class']::createNavigationItem());
            // } else {
               
            // }

            // if ($value['class'] == 'App\Yali\Resources\UserResource') {
            //     dd($value['class']::getTitle(), $value['class']::getModel());
            // }
            $this->navigation->add($value['class']::createNavigationItem());
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
