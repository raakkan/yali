<?php

namespace Raakkan\Yali\Core\Support\Navigation;

use Illuminate\Support\Str;
use Raakkan\Yali\App\DashboardPage;
use Raakkan\Yali\App\LanguagesPage;
use Raakkan\Yali\App\HandleResourcePage;
use Raakkan\Yali\Core\FileManager\FileManagerPage;
use Raakkan\Yali\Core\Settings\GeneralSettingsPage;

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
        $this->navigation->add(GeneralSettingsPage::createNavigationItem());

        foreach ($pages as $value) {
            $this->navigation->add($value['class']::createNavigationItem());
        }
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
