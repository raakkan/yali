<?php 

use Illuminate\Support\Facades\Route;
use Raakkan\Yali\App\DashboardPage;
use Raakkan\Yali\Core\Facades\YaliManager;

// Route::get('/admin', function() {
//     return view('yali::pages.page-component');
// })->name('admin');

// dd(YaliManager::getPages());

Route::prefix('admin')->group(function () {
    Route::get('/', DashboardPage::class)->name('yali::pages.dashboard');
});