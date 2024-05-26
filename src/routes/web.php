<?php 

use Illuminate\Support\Facades\Route;
use Raakkan\Yali\App\DashboardPage;
use Raakkan\Yali\App\HandleResourcePage;
use Raakkan\Yali\App\ResourcePage;
use Raakkan\Yali\Core\Facades\YaliManager;

Route::prefix('admin')->group(function () {
    Route::get('/', DashboardPage::class)->name('yali::pages.dashboard');

    $navigation = YaliManager::getNavigation();
    
    foreach ($navigation->getAllItems() as $page) {
        if ($page->getRouteName() !== 'yali::pages.dashboard' && $page->getType() === 'page') {
            Route::get($page->getSlug(), $page->getClass())->name($page->getRouteName());

            foreach ($page->getChildrens() as $childItem) {
                Route::get($childItem->getSlug(), $childItem->getClass())->name($childItem->getRouteName());
            }
        }
    
        if ($page->getType() === 'resource') {
            Route::get('/'.$page->getSlug(), ResourcePage::class)->name($page->getRouteName())
            ->defaults('resource', $page->getClass());
    
            foreach ($page->getChildrens() as $childItem) {
                Route::get($childItem->getSlug(), $childItem->getClass())->name($childItem->getRouteName())
                ->defaults('resource', $page->getClass());
            }
        }
    }
    
});