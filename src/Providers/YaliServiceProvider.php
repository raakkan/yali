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
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'yali');
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        $this->loadPlugIns();
    }

    public function loadPlugIns(): void
    {
        $manager = new PlugInManager();
        $manager->discoverPlugins(base_path('plugins'));
        $manager->loadPlugins();
    }
}
