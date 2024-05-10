<?php

namespace Raakkan\Yali\Providers;

use Livewire\Livewire;
use Illuminate\Support\ServiceProvider;
use Raakkan\Yali\Core\Pages\PageLoader;
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
            $page = new PageLoader($this->app);
            $page->loadAdminPages();
            dd($page->getPages());
            $this->app->singleton(PluginConfigHelper::class, function ($app) {
                return new PluginConfigHelper();
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
            // Register the plugin manager in your service provider
            $this->app->singleton(PluginManager::class, function ($app) {
                return new PluginManager($app);
            });
    
            // Discover and register plugins
            $pluginManager = $this->app->make(PluginManager::class);
            $pluginManager->discoverPlugins(base_path('plugins'));
    
            // Boot the registered plugins
            $pluginManager->boot();
        }
    
}
