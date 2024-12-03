<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProductDetailsController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\Admin\Auth\RegisterController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BasketController;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;


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

// Basket Route
Route::get('/basket', [BasketController::class,'index'])->name('basket'); 



// Route to go to dashboard and clear cache to prevent csrf
Route::get('/dashboard', function () {
    $user = Auth::user();  // Get the authenticated user
    
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
    Route::post('/subscribe', [ProfileController::class, 'subscribe'])->name('subscribe');
    Route::post('/unsubscribe', [ProfileController::class, 'unsubscribe'])->name('unsubscribe');
});

// Requires the user to be authenticated and verified, calls update method to update data then edit method
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile.search', [ProfileController::class, 'search'])->name('profile.search');
    Route::get('/profile.editAdmin', [ProfileController::class, 'editAdmin'])->name('profile.editAdmin');
    Route::patch('/profile.updateAdmin', [ProfileController::class, 'updateAdmin'])->name(name: 'profile.updateAdmin');
});

// Route to delete the user's profile, no authentication or verification
Route::patch('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
Route::patch('/profile/{id}', [ProfileController::class, 'destroyOther'])->name('profile.destroyOther');

Route::prefix('admin')->group(function () {
    Route::get('/auth/register', [RegisterController::class, 'create'])->name('admin.register');
    Route::post('/auth/register', [RegisterController::class, 'register'])->name('admin.register');
});

// Route to add and delete category
Route::post('category.add', [CategoryController::class, 'add'])->name('category.add');
Route::post('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
Route::patch('/category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');

// Route to add a product
Route::post('add_product', [ProductsController::class, 'add_product'])->name('add_product');

Route::get('admin.dashboard', function () {
    $admin = Auth::user(); // Get the authenticated admin
    
    // Paginate users with 10 users per page 
    $users = \App\Models\User::where('userType', '!=', 'admin')->paginate(10)->appends(['tab' => 'allUsers']);

    // Paginate categories with 5 categories per page 
    $categories = Category::paginate(5)->appends(['tab' => 'allProducts']);

    
    return response(view('admin.dashboard', compact('admin', 'users', 'categories')))
        ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
        ->header('Pragma', 'no-cache')
        ->header('Expires', '0');
})->middleware(['auth', 'verified'])->name('admin.dashboard');

require __DIR__.'/auth.php';

// Route to display the list of blog posts
Route::get('/blogs',[BlogController::class, 'index'])->name('blogs.index');

/** 
 * Both routes require the user to be authenticated
 * First route displays the blog creation form
 * Second route stores the blog post that was made
 * */  
Route::middleware(['auth'])->group(function() {
    Route::get('/blogs/create', [BlogController::class, 'create'])->name('blogs.create');
    Route::post('/blogs', [BlogController::class, 'store'])->name('blogs.store');
});