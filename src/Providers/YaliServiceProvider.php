<?php 

declare(strict_types=1);

namespace Raakkan\Yali\Providers;

use App\Models\Page;
use App\Models\User;
use Livewire\Livewire;
use BladeUI\Icons\Factory;
use Raakkan\Yali\App\ResourcePage;
use Raakkan\Yali\App\PageComponent;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Raakkan\Yali\Core\Pages\PageManager;
use Raakkan\Yali\App\Pages\DashboardPage;
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
        $this->app->singleton(PageManager::class, function ($app) {
            return new PageManager();
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
        $resourceManager->registerReources();
    }

    public function loadNavigation(): void
    {
        $navigationManager = $this->app->make(NavigationManager::class);
        $navigationManager->loadPageMenus();
        $navigationManager->loadResourceMenus();

        // dd($navigationManager->getMenus());
    }
}
