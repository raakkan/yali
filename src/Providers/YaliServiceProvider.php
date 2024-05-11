<?php 

declare(strict_types=1);

namespace Raakkan\Yali\Providers;

use Livewire\Livewire;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Raakkan\Yali\App\Pages\DashboardPage;
use Raakkan\Yali\Core\NavigationManager;
use Raakkan\Yali\Core\Pages\PageManager;

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

        $this->app->singleton(NavigationManager::class, function ($app) {
            return new NavigationManager($app);
        });

        $this->loadPages();
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

        // // Set the main page route
        // $mainPageClass = DashboardPage::class;
        // Route::prefix('admin')->group(function () use ($mainPageClass) {
        //     Route::get('/', $mainPageClass)->name('yali::pages.dashboard');
        // });

        $pageManager->registerPages();

    }

    public function loadNavigation(): void
    {
        $navigationManager = $this->app->make(NavigationManager::class);
        $navigationManager->loadPageMenus();
    }
}
