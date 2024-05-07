<?php 

use Illuminate\Support\Facades\Route;

Route::get('/yali', function () {
    return view('yali::welcome');
});