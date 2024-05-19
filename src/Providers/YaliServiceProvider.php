<?php 

declare(strict_types=1);

namespace Raakkan\Yali\Providers;

use Livewire\Livewire;
use BladeUI\Icons\Factory;
use Raakkan\Yali\App\ResourcePage;
use Raakkan\Yali\App\PageComponent;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Raakkan\Yali\Core\Pages\Manager\PageFactory;
use Raakkan\Yali\Core\Pages\PageManager;
use Illuminate\Contracts\Container\Container;
use Raakkan\Yali\Core\Pages\Manager\PageService;
use Raakkan\Yali\Core\Resources\ResourceManager;
use Raakkan\Yali\Core\Pages\Manager\PageRepository;
use Raakkan\Yali\Core\Resources\Table\ResourceTable;
use Raakkan\Yali\Core\Support\Navigation\NavigationManager;

class YaliServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(PageFactory::class, function () {
            return new PageFactory();
        });

        $this->app->singleton(PageRepository::class, function () {
            return new PageRepository();
        });

        $this->app->singleton(PageService::class, function ($app) {
            return new PageService($app->make(PageRepository::class), $app->make(PageFactory::class));
        });

        $this->app->singleton('pagemanager', function ($app) {
            return new PageManager($app->make(PageService::class));
        });

        $this->app->singleton(ResourceManager::class, function ($app) {
            return new ResourceManager();
        });

        $this->app->singleton(NavigationManager::class, function ($app) {
            return new NavigationManager($app);
        });

        $this->callAfterResolving(Factory::class, function (Factory $factory, Container $container) {
            $factory->add('yali-icon', array_merge(['path' => __DIR__.'/../../resources/icons'], ['prefix' => 'yali::icon']));
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'yali');
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');

        $this->loadPages();
        $this->loadResources();
        $this->loadNavigation();
    }

    public function loadPages(): void
    {
        Livewire::setUpdateRoute(function ($handle) {
            return Route::post('/yali/livewire/update', $handle);
        });
        Livewire::component('yali::page-component', PageComponent::class);

        // Discover and register pages
        $pageManager = $this->app->make(PageManager::class);
        $pageManager->loadAdminPages();
        $pageManager->loadAppPages();

        $pageManager->registerPages();

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
