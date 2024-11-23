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

Route::middleware(['guest'])->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
});

// route for book
Route::get('/book', [PublicController::class, 'book']);
Route::post('/book/borrow/{id}', [PublicController::class, 'borrow'])->name('book.borrow');
Route::resource('public', PublicController::class);

Route::middleware(['auth'])->group(function () {
    Route::get('/borrowed', [PublicController::class, 'borrowed']);
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

// Route group untuk admin
Route::middleware(['role'])->group(function () {
    Route::prefix('admin')->group(function () {
        // User Controller
        Route::resource('user', UserController::class);

        // Book Controller
        // Route untuk melihat list peminjaman buku
        Route::get('/books/borrowed', [BookController::class, 'borrowed'])->name('books.borrowed');

        // Route untuk memperbarui status buku
        Route::patch('/books/{id}/status', [BookController::class, 'updateStatus'])->name('books.updateStatus');
        Route::resource('book', BookController::class);

        // Category Controller
        Route::resource('category', CategoryController::class);
    });
});
