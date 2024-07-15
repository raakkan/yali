<?php

use Illuminate\Support\Facades\Route;
use Raakkan\Yali\Core\FileManager\Controllers\FileManagerController;

Route::prefix('admin')->group(function () {
    Route::get('/file-manager', [FileManagerController::class, 'index'])->name('file-manager.index');
    Route::post('/file-manager/folders', [FileManagerController::class, 'createFolder'])->name('file-manager.create-folder');
    Route::delete('/file-manager/delete', [FileManagerController::class, 'delete'])->name('file-manager.delete');
    Route::post('/file-manager/upload', [FileManagerController::class, 'upload'])->name('file-manager.upload');
});
