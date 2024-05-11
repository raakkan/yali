<?php 

declare(strict_types=1);

namespace Raakkan\Yali\Providers;

use Livewire\Livewire;
use Raakkan\Yali\App\ResourcePage;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Raakkan\Yali\Core\Pages\PageManager;
use Raakkan\Yali\App\Pages\DashboardPage;
use Raakkan\Yali\Core\Resources\ResourceManager;
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

        $this->loadPages();
        $this->loadResources();
        $this->loadNavigation();
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'yali');
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        // $this->mergeConfigFrom(
        //     __DIR__.'/../../config/plugins.php', 'yali'
        // );
    }

    public function loadPages(): void
    {
        // Discover and register pages
        $pageManager = $this->app->make(PageManager::class);
        $pageManager->loadAdminPages();
        $pageManager->loadAppPages();

        $pageManager->registerPages();

    }

    public function loadResources(): void
    {
        Livewire::component('yali::resource-page', ResourcePage::class);

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
