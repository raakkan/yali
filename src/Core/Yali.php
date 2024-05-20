<?php

namespace Raakkan\Yali\Core;

use Raakkan\Yali\Core\Pages\PageManager;
use Raakkan\Yali\Core\Support\Navigation\NavigationManager;

class Yali
{
    protected $app;
    protected $pageManager;
    protected $pluginManager;
    protected $resourceManager;
    protected $navigationManager;

    public function __construct($app) {
        $this->app = $app;
        $this->pageManager = $this->app->make(PageManager::class);
        $this->navigationManager = $this->app->make(NavigationManager::class);
    }

    public function boot() {
        $this->pageManager->loadPages();
        $this->pageManager->registerPages();
    }

    public function getPages() {
        return $this->pageManager->getPages();
    }
}
