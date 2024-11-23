<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// route group for public

Route::get('/', [PublicController::class, 'index'])->name('home');
// route for login
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);

Route::post('logout', [AuthController::class, 'logout'])->name('logout');
// route for book
Route::get('/book', [PublicController::class, 'book']);
Route::resource('public', PublicController::class);

// route group for admin
Route::prefix('admin')->group(function () {
    Route::resource('user', UserController::class);

    Route::resource('book', BookController::class);

    Route::resource('category', CategoryController::class);
});
