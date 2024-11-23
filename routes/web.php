<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.user.create');
});

// route group for admin
Route::prefix('admin')->group(function () {
    Route::resource('user', UserController::class);

    Route::resource('book', BookController::class);
});
