<?php 

use Raakkan\Yali\App\ResourcePage;
use Raakkan\Yali\App\DashboardPage;
use Illuminate\Support\Facades\Route;
use Raakkan\Yali\App\HandleResourcePage;
use Raakkan\Yali\Core\Facades\YaliManager;
use Raakkan\Yali\Core\Support\Notification\NotificationManager;

Route::prefix('admin')->group(function () {
    Route::get('/', DashboardPage::class)->name('yali::pages.dashboard');

    $navigation = YaliManager::getNavigation();
    
    foreach ($navigation->getAllItems() as $page) {
        if ($page->getRouteName() !== 'yali::pages.dashboard') {
            Route::get($page->getSlug(), $page->getClass())->name($page->getRouteName());

            foreach ($page->getChildrens() as $childItem) {
                Route::get($childItem->getSlug(), $childItem->getClass())->name($childItem->getRouteName());
            }
        }
    }

    Route::get('/notifications/fetch', function () {
        $notifications = app(NotificationManager::class)->getNotifications();
        return response()->json($notifications);
    })->name('notifications.fetch');
    
});