<?php 

declare(strict_types=1);

namespace Raakkan\Yali\Providers;

use Raakkan\Yali\Core\Yali;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use Raakkan\Yali\Core\Pages\PageManager;
use Raakkan\Yali\Core\Facades\YaliManager;
use Raakkan\Yali\Core\Events\ActionExecuted;

use Raakkan\Yali\Core\FileManager\FileManager;
use Raakkan\Yali\Core\Support\Icon\IconManager;
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
        Event::listen(
            ActionExecuted::class,
        );
        
        YaliManager::boot();
        
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'yali');
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');

        // Load Web Routes
        Route::middleware('web')
            ->group(__DIR__.'/../routes/web.php');

        // Load API Routes
        Route::prefix('api')
            ->middleware('api')
            ->group(__DIR__.'/../routes/api.php');

        $this->app['yali-icon']->loadIcons();

        // on('dehydrate', function (Component $component) {
        //     if (!Livewire::isLivewireRequest()) {
        //         return;
        //     }

        //     if ($component->getName() === 'raakkan.yali.app.languages-page') {
        //         Log::info($component->getName() . ' dehydrated');
        //         $component->dispatch('notifications-sent');
        //     }
            
        // });
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
