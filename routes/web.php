<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\BlogController;

// Home route
Route::get('/', [HomeController::class, 'index'])->name('home');

// Products route
Route::get('/products', [ProductsController::class, 'index'])->name('products');

// About Us route
Route::get('/about-us', [AboutUsController::class, 'index'])->name('about-us');

// Blog route
Route::get('/blog', [BlogController::class, 'index'])->name('blog');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

require __DIR__.'/auth.php';
