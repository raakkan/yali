<?php 

declare(strict_types=1);

namespace Raakkan\Yali\Providers;

use Livewire\Livewire;
use Raakkan\Yali\Core\Yali;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Raakkan\Yali\Core\Pages\PageManager;
use Raakkan\Yali\Core\Facades\YaliManager;
use Raakkan\Yali\Core\Support\Icon\IconManager;
use Raakkan\Yali\Core\Translation\YaliTranslator;
use Raakkan\Yali\Core\Support\Navigation\NavigationManager;

class YaliServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {

        $this->app->singleton(PageManager::class, function () {
            return new PageManager();
        });

        $this->app->singleton(NavigationManager::class, function ($app) {
            return new NavigationManager();
        });

        $this->app->singleton('yali-manager', function ($app) {
            return new Yali($app);
        });

        $this->app->singleton('yali-icon', function ($app) {
            $iconLoader = $app->make('yali-manager')->getIconLoader();
            return new IconManager($iconLoader);
        });

        $this->registerCommands();
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        YaliManager::boot();
        
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'yali');
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');

        $this->app['yali-icon']->loadIcons();

        Livewire::setUpdateRoute(function ($handle) {
            return Route::post('/yali/livewire/update', $handle);
        });

        // $this->loadSeeders();
    }

    protected function loadSeeders()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../../database/seeders' => database_path('seeders'),
            ], 'yali-seeders');
        }
    }

    protected function registerCommands()
    {
        $this->commands([
            \Raakkan\Yali\Core\Console\Commands\YaliCommands::class,
            \Raakkan\Yali\Core\Console\Commands\LoadTranslationsCommand::class,
            \Raakkan\Yali\Core\Console\Commands\MakeResourceCommand::class
        ]);
    }

}
