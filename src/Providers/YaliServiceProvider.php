<?php 

declare(strict_types=1);

namespace Raakkan\Yali\Providers;

use Raakkan\Yali\Core\Yali;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use Raakkan\Yali\Core\Pages\PageManager;
use Raakkan\Yali\Core\Events\ActionExecuted;

use Raakkan\Yali\Core\FileManager\FileManager;
use Raakkan\Yali\Core\Settings\SettingsManager;
use Raakkan\Yali\Core\Support\Icon\IconManager;
use Raakkan\Yali\Core\Translation\LocaleConfig;
use Raakkan\Yali\Core\Support\Log\YaliLogManager;
use Raakkan\Yali\Core\Support\Facades\YaliManager;
use Raakkan\Yali\Core\Support\Navigation\NavigationManager;

class YaliServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/yali.php', 'yali');

        $this->app->singleton('yali-settings', function ($app) {
            return new SettingsManager();
        });

        $this->app->singleton('yali.log', function () {
            return new YaliLogManager();
        });

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
            return new IconManager();
        });

        $this->app->singleton(LocaleConfig::class, function ($app) {
            return new LocaleConfig(config('yali.locales'));
        });

        $this->app->bind(FileManager::class, function ($app) {
            return new FileManager(Storage::disk('public'));
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
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');

        Route::middleware('web')
            ->group(__DIR__.'/../routes/web.php');

        Route::prefix('api')
            ->middleware('api')
            ->group(__DIR__.'/../routes/api.php');
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
            \Raakkan\Yali\Core\Console\Commands\MakeResourceCommand::class,
            \Raakkan\Yali\Core\Database\Console\Commands\YaliMigrateCommand::class,
        ]);
    }

}
