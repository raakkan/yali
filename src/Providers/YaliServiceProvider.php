<?php 

declare(strict_types=1);

namespace Raakkan\Yali\Providers;

use Livewire\Livewire;
use BladeUI\Icons\Factory;
use Raakkan\Yali\Core\Yali;
use Raakkan\Yali\App\ResourcePage;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Raakkan\Yali\Core\Pages\PageManager;
use Raakkan\Yali\Core\Facades\YaliManager;
use Illuminate\Contracts\Container\Container;
use Raakkan\Yali\Core\Resources\ResourceManager;
use Raakkan\Yali\Core\Resources\Table\ResourceTable;
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

        $this->app->singleton(ResourceManager::class, function ($app) {
            return new ResourceManager();
        });

        // $this->callAfterResolving(Factory::class, function (Factory $factory, Container $container) {
        //     $factory->add('yali-icon', array_merge(['path' => __DIR__.'/../../resources/icons'], ['prefix' => 'yali::icon']));
        // });
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

        Livewire::setUpdateRoute(function ($handle) {
            return Route::post('/yali/livewire/update', $handle);
        });
    }

    public function loadResources(): void
    {
        Livewire::component('yali::resource-page', ResourcePage::class);
        Livewire::component('yali::resource-table', ResourceTable::class);

        $resourceManager = $this->app->make(ResourceManager::class);
        $resourceManager->loadAppResources();
        $resourceManager->registerResources();
    }

    public function loadNavigation(): void
    {
        $navigationManager = $this->app->make(NavigationManager::class);
        $navigationManager->loadPageMenus();
        $navigationManager->loadResourceMenus();

        // dd($navigationManager->getMenus());
    }
}
