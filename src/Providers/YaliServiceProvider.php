<?php 

declare(strict_types=1);

namespace Raakkan\Yali\Providers;

use Illuminate\Support\ServiceProvider;
use Raakkan\Yali\Core\PlugInManager\PlugInManager;

class YaliServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'yali');
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        $this->loadPlugIns();
    }

    public function loadPlugIns(): void
    {
        // Register the plugin manager in your service provider
        $this->app->singleton(PluginManager::class, function ($app) {
            return new PluginManager();
        });

        // Discover and register plugins
        $pluginManager = $this->app->make(PluginManager::class);
        $pluginManager->discoverPlugins(base_path('plugins'));

        // Boot the registered plugins
        $pluginManager->boot();
    }
}
