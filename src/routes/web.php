<?php 

use Illuminate\Support\Facades\Route;
use Raakkan\Yali\App\DashboardPage;
use Raakkan\Yali\Core\Facades\YaliManager;

Route::prefix('admin')->group(function () {
    Route::get('/', DashboardPage::class)->name('yali::pages.dashboard');

    $navigation = YaliManager::getNavigation();

    foreach ($navigation->getItems() as $page) {
        if ($page->getRouteName() !== 'yali::pages.dashboard') {
            Route::get($page->getSlug(), $page->getClass())->name($page->getRouteName());
        }
    }
});