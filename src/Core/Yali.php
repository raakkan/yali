<?php

namespace Raakkan\Yali\Core;

use Livewire\Livewire;
use Livewire\Mechanisms\ComponentRegistry;
use Raakkan\Yali\App\DashboardPage;
use Raakkan\Yali\App\LanguagesPage;
use Raakkan\Yali\App\ManageTranslationPage;
use Raakkan\Yali\Core\Actions\Modals\ActionConfirmationModal;
use Raakkan\Yali\Core\Actions\Modals\ActionModal;
use Raakkan\Yali\Core\FileManager\FileManagerPage;
use Raakkan\Yali\Core\Pages\PageManager;
use Raakkan\Yali\Core\Settings\YaliSettingsPage;
use Raakkan\Yali\Core\Support\Facades\YaliSetting;
use Raakkan\Yali\Core\Support\Navigation\NavigationManager;
use Raakkan\Yali\Core\Support\Notification\Livewire\Notifications;

class Yali
{
    protected $app;

    protected $pageManager;

    protected $pluginManager;

    protected $navigationManager;

    protected $componentRegistry;

    public function __construct($app)
    {
        $this->app = $app;
        $this->pageManager = $this->app->make(PageManager::class);

        $this->navigationManager = $this->app->make(NavigationManager::class);

        $this->componentRegistry = $this->app->make(ComponentRegistry::class);
    }

    public function boot()
    {
        YaliSetting::registerSettings(YaliSettingsPage::getSettingFields());

        $this->pageManager->loadPages();

        $this->registerLivewireComponents();

        $this->navigationManager->build($this->pageManager->getPages());

    }

    public function registerLivewireComponents()
    {
        Livewire::component($this->componentRegistry->getName(DashboardPage::class), DashboardPage::class);
        Livewire::component($this->componentRegistry->getName(LanguagesPage::class), LanguagesPage::class);

        Livewire::component('yali::action-modal', ActionModal::class);
        Livewire::component('yali::action-confirmation-modal', ActionConfirmationModal::class);

        Livewire::component('yali::manage-translation', ManageTranslationPage::class);

        Livewire::component('yali::file-manager', FileManagerPage::class);

        Livewire::component('yali::settings.general-page', YaliSettingsPage::class);

        Livewire::component('yali::notifications-component', Notifications::class);

        foreach ($this->getPages() as $page) {
            Livewire::component($this->componentRegistry->getName($page['class']), $page['class']);

            if (method_exists($page['class'], 'getPages')) {
                foreach ($page['class']::getPages() as $subPage) {
                    Livewire::component($this->componentRegistry->getName($subPage), $subPage);
                }
            }
        }
    }

    public function getPages()
    {
        return $this->pageManager->getPages();
    }

    public function getResources()
    {
        return [];
    }

    public function getNavigation()
    {
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

    public function getNavigationManager()
    {
        return $this->navigationManager;
    }
}
