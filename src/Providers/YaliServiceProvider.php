<?php 

declare(strict_types=1);

namespace Raakkan\Yali\Providers;

use Illuminate\Support\ServiceProvider;

class YaliServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        
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
}
