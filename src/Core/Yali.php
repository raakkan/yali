<?php

namespace Raakkan\Yali\Core;

use Livewire\Livewire;
use Raakkan\Yali\App\ResourcePage;
use Raakkan\Yali\App\DashboardPage;
use Raakkan\Yali\App\HandleResourcePage;
use Raakkan\Yali\Core\Pages\PageManager;
use Livewire\Mechanisms\ComponentRegistry;
use Raakkan\Yali\App\ManageTranslationPage;
use Raakkan\Yali\Core\Resources\ResourceTable;
use Raakkan\Yali\Core\Resources\ResourceManager;
use Raakkan\Yali\Core\Actions\ActionModalComponent;
use Raakkan\Yali\Core\Support\Icon\Loader\IconLoader;
use Raakkan\Yali\Core\Support\Navigation\NavigationManager;

class Yali
{
    protected $app;
    protected $pageManager;
    protected $pluginManager;
    protected $navigationManager;
    protected $iconLoader;
    protected $componentRegistry;

    public function __construct($app) {
        $this->app = $app;
        $this->pageManager = $this->app->make(PageManager::class);

        $this->navigationManager = $this->app->make(NavigationManager::class);

        $this->componentRegistry = $this->app->make(ComponentRegistry::class);

        $this->iconLoader = new IconLoader();
    }

    public function boot() {

        $this->pageManager->loadPages();

        $this->registerLivewireComponents();

        $this->navigationManager->build($this->pageManager->getPages());
    }

    public function registerLivewireComponents() {
        Livewire::component($this->componentRegistry->getName(DashboardPage::class), DashboardPage::class);

        Livewire::component('yali::action-modal-component', ActionModalComponent::class);

        Livewire::component('yali::manage-translation', ManageTranslationPage::class);

        foreach ($this->getPages() as $page) {
            Livewire::component($this->componentRegistry->getName($page['class']), $page['class']);

            if (method_exists($page['class'], 'getPages')) {
                foreach ($page['class']::getPages() as $subPage) {
                    Livewire::component($this->componentRegistry->getName($subPage), $subPage);
                }
            }
        }
    }

    public function getPages() {
        return $this->pageManager->getPages();
    }

    public function getResources() {
        return [];
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

    public function getIconLoader()
    {
        return $this->iconLoader;
    }

    public function getNavigationManager()
    {
        return $this->navigationManager;
    }
}
