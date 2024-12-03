<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProductDetailsController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Auth;

// Home route
Route::get('/', [HomeController::class, 'index'])->name('home');

// Products route
Route::get('/products', [ProductsController::class, 'index'])->name('products');

// Product details route
Route::get('/product-details', [ProductsController::class, 'details'])->name('product-details');

// About Us route
Route::get('/about-us', [AboutUsController::class, 'index'])->name('about-us');

// Blog route
Route::get('/blog', [BlogController::class, 'index'])->name('blog');

// Route to go to dashboard and clear cache to prevent csrf
Route::get('/dashboard', function () {
    $user = Auth::user();  // Get the authenticated user
    return response(view('dashboard', compact('user')))
        ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
        ->header('Pragma', 'no-cache')
        ->header('Expires', '0');
})->middleware(['auth', 'verified'])->name('dashboard');

// Requires the user to be authenticated and verified, calls updaet method to update data then edit method
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile.edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile.update', [ProfileController::class, 'update'])->name('profile.update');
});

// Route to delete the user's profile, no authentication or verification
Route::patch('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

require __DIR__.'/auth.php';
