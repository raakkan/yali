<?php
use Illuminate\Support\Facades\Route;
use Raakkan\Yali\Core\FileManager\Controllers\FileManagerController;

Route::prefix('admin')->group(function () {
    Route::get('/file-manager', [FileManagerController::class,'index'])->name('file-manager.index');
});