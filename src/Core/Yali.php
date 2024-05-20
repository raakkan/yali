<?php

namespace Raakkan\Yali\Core;

use Livewire\Livewire;
use Raakkan\Yali\App\DashboardPage;
use Raakkan\Yali\Core\Pages\PageManager;
use Livewire\Mechanisms\ComponentRegistry;
use Raakkan\Yali\Core\Support\Navigation\NavigationManager;

class Yali
{
    protected $beforeBootCallbacks = [];
    protected $afterBootCallbacks = [];

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

        $this->componentRegistry = $this->app->make(ComponentRegistry::class);
    }

    public function boot() {
        foreach ($this->beforeBootCallbacks as $callback) {
            $callback($this);
        }

        $this->pageManager->loadPages();

        $this->registerLivewireComponents();

        $this->navigationManager->build($this->getPages());

        foreach ($this->afterBootCallbacks as $callback) {
            $callback($this);
        }
    }

    public function registerLivewireComponents() {
        Livewire::component($this->componentRegistry->getName(DashboardPage::class), DashboardPage::class);
    }

    public function getPages() {
        return $this->pageManager->getPages();
    }

    public function getNavigation() {
        return $this->navigationManager->getNavigation();
    }

    public function beforeBoot(callable $callback): void
    {
        $this->beforeBootCallbacks[] = $callback;
    }

    public function afterBoot(callable $callback): void
    {
        $this->afterBootCallbacks[] = $callback;
    }

}
