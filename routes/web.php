<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\Admin\Auth\RegisterController;
use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Auth;

// Home route
Route::get('/', [HomeController::class, 'index'])->name('home');

// Products route
Route::get('/products', [ProductsController::class, 'index'])->name('products');

// About Us route
Route::get('/about-us', [AboutUsController::class, 'index'])->name('about-us');

// Blog route
Route::get('/blog', [BlogController::class, 'index'])->name('blog');

Route::get('/dashboard', function () {
    $user = Auth::user();  // Get the authenticated user

    $users = \App\Models\User::where('userType', '!=', 'admin')->get();
    
    // Check if the user is an admin based on their userType
    if ($user->userType == 'admin') {
        return response(view('admin.dashboard', compact('user')))
            ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }
    
    // Return the regular dashboard for non-admin users
    return response(view('dashboard', compact('user')))
        ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
        ->header('Pragma', 'no-cache')
        ->header('Expires', '0');
})->middleware(['auth', 'verified'])->name('dashboard');


// Requires the user to be authenticated and verified, calls update method to update data then edit method
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile.edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile.update', [ProfileController::class, 'update'])->name('profile.update');
});

// Requires the user to be authenticated and verified, calls update method to update data then edit method
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile.editAdmin', [ProfileController::class, 'editAdmin'])->name('profile.editAdmin');
    Route::patch('/profile.updateAdmin', [ProfileController::class, 'updateAdmin'])->name('profile.updateAdmin');
});

// Route to delete the user's profile, no authentication or verification
Route::patch('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

Route::prefix('admin')->group(function () {
    Route::get('/auth/register', [RegisterController::class, 'create'])->name('admin.register');
    Route::post('/auth/register', [RegisterController::class, 'register'])->name('admin.register');
});

// Route to go to dashboard and display all users
Route::get('admin.dashboard', function () {
    $user = Auth::user();  // Get the authenticated user
    
    // Get all users except admins
    $users = \App\Models\User::where('userType', '!=', 'admin')->get();
    
    return response(view('admin.dashboard', compact('user', 'users')))
        ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
        ->header('Pragma', 'no-cache')
        ->header('Expires', '0');
})->middleware(['auth', 'verified'])->name('admin.dashboard');



require __DIR__.'/auth.php';
