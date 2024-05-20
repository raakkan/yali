<?php

namespace Raakkan\Yali\Core;

use Livewire\Livewire;
use Raakkan\Yali\App\DashboardPage;
use Raakkan\Yali\Core\Pages\PageManager;
use Livewire\Mechanisms\ComponentRegistry;
use Raakkan\Yali\Core\Resources\ResourceManager;
use Raakkan\Yali\Core\Support\Navigation\NavigationManager;

class Yali
{
    protected $app;
    protected $pageManager;
    protected $pluginManager;
    protected $resourceManager;
    protected $navigationManager;

    protected $componentRegistry;

    public function __construct($app) {
        $this->app = $app;
        $this->pageManager = $this->app->make(PageManager::class);
        $this->navigationManager = $this->app->make(NavigationManager::class);

        $this->resourceManager = $this->app->make(ResourceManager::class);

        $this->componentRegistry = $this->app->make(ComponentRegistry::class);
    }

    public function boot() {

        $this->pageManager->loadPages();
        $this->resourceManager->loadResources();

        $this->registerLivewireComponents();

        $this->navigationManager->build(array_merge($this->pageManager->getPages(), $this->resourceManager->getResources()));
    }

    public function registerLivewireComponents() {
        Livewire::component($this->componentRegistry->getName(DashboardPage::class), DashboardPage::class);
    }

    public function getPages() {
        return $this->pageManager->getPages();
    }

    public function getResources() {
        return $this->resourceManager->getResources();
    }

    public function getNavigation() {
        return $this->navigationManager->getNavigation();
    }

    public function resolveResource($resource)
    {
        $resources = $this->getResources();
    
        if (isset($resources[$resource])) {
            return $resources[$resource];
        }
    
        throw new \InvalidArgumentException("Resource '{$resource}' not found.");
    }    
}
