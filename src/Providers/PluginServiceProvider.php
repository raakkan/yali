<?php

namespace Raakkan\Yali\Providers;

use Livewire\Livewire;
use Illuminate\Support\ServiceProvider;
use Raakkan\Yali\Core\Pages\PageManager;
use Raakkan\Yali\Core\Plugin\PluginManager;
use Raakkan\Yali\Core\Plugin\Dtos\PluginSynth;
use Raakkan\Yali\Core\Plugin\PluginConfigHelper;
use Raakkan\Yali\Core\Resources\ResourceManager;
use Raakkan\Yali\Core\Support\Navigation\NavigationManager;

class PluginServiceProvider extends ServiceProvider
{
    /**
         * Register services.
         *
         * @return void
         */
        public function register()
        {
            $this->app->singleton(PluginConfigHelper::class, function ($app) {
                return new PluginConfigHelper();
            });

            $this->app->singleton(PluginManager::class, function ($app) {
                return new PluginManager($app);
            });
        }
    
        /**
         * Bootstrap services.
         *
         * @return void
         */
        public function boot()
        {
            Livewire::propertySynthesizer(PluginSynth::class);

            $this->loadPlugIns();
        }

        public function loadPlugIns(): void
        {
            // Discover and register plugins
            $pluginManager = $this->app->make(PluginManager::class);
            $pluginManager->discoverPlugins(base_path('plugins'));
    
            // Boot the registered plugins
            $pluginManager->boot();

            $pageManager = $this->app->make(PageManager::class);
            $pageManager->loadPluginPages($pluginManager->getAvailablePages());
            $pageManager->registerPages();

            $resourceManager = $this->app->make(ResourceManager::class);
            $resourceManager->loadPluginResources($pluginManager->getAvailableResources());
            $resourceManager->registerResources();

            $navigationManager = $this->app->make(NavigationManager::class);
            $navigationManager->loadPageMenus();
            $navigationManager->loadResourceMenus();
        }
    
}
