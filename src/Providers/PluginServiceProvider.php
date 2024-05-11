<?php

namespace Raakkan\Yali\Providers;

use Livewire\Livewire;
use Illuminate\Support\ServiceProvider;
use Raakkan\Yali\Core\NavigationManager;
use Raakkan\Yali\Core\Pages\PageManager;
use Raakkan\Yali\Core\Plugin\PluginManager;
use Raakkan\Yali\Core\Plugin\Dtos\PluginSynth;
use Raakkan\Yali\Core\Plugin\PluginConfigHelper;

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

            $this->loadPlugIns();
        }
    
        /**
         * Bootstrap services.
         *
         * @return void
         */
        public function boot()
        {
            Livewire::propertySynthesizer(PluginSynth::class);
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

            $navigationManager = $this->app->make(NavigationManager::class);
            $navigationManager->loadPageMenus();

            // dd($pageManager->getPages());
        }
    
}
