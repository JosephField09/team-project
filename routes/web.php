<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\Admin\Auth\RegisterController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

// Home route
Route::get('/', [HomeController::class, 'index'])->name('home');

// Products route
Route::get('/products', [ProductsController::class, 'index'])->name('products');

// Product details route
Route::get('/product/{id}', [ProductsController::class, 'details'])->name('product-details');

// Product reviews routes
Route::get('/product/{id}/review', [ReviewController::class, 'create_review'])
    ->name('reviews.create')
    ->middleware(['auth', 'verified']);
Route::post('/product/{id}/review', [ReviewController::class, 'add_review'])
    ->name('reviews.add')
    ->middleware(['auth', 'verified']);

// Checkout page route
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'add'])->name('checkout.add');

// About Us route
Route::get('/about-us', [AboutUsController::class, 'index'])->name('about-us');

// Contact Us route
Route::get('/contact-us', [ContactUsController::class, 'index'])->name('contact-us');

// Blog route
Route::get('/blog', [BlogController::class, 'index'])->name('blog');

// Basket Route
Route::get('/basket', [BasketController::class, 'index'])->name('basket');
Route::post('basket.add/{id}', [BasketController::class, 'add'])
    ->name('basket.add')
    ->middleware(['auth', 'verified']);

Route::post('/basket/remove/{id}', [BasketController::class, 'remove'])
    ->name('basket.remove')
    ->middleware(['auth', 'verified']);

Route::post('/basket/update/{id}', [BasketController::class, 'update'])
    ->name('basket.update')
    ->middleware(['auth', 'verified']);

/**
 * Normal user dashboard:
 * - If user is admin, redirect to the admin dashboard.
 * - Otherwise, load the user’s orders and show the regular dashboard.
 */
Route::get('/dashboard', function () {
    $user = Auth::user(); // Get the authenticated user

    if ($user->userType === 'admin') {
        // Redirect admin to admin dashboard
        return redirect()->route('admin.dashboard');
    }

    // For normal users, load orders for display on the standard dashboard
    $orders = Order::where('user_id', $user->id)
        ->with('orderItems.product')
        ->get();

    return response(view('dashboard', compact('user', 'orders')))
        ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
        ->header('Pragma', 'no-cache')
        ->header('Expires', '0');
})->middleware(['auth', 'verified'])->name('dashboard');

/**
 * Admin dashboard:
 * - We use a controller to fetch KPI data (totalOrders, totalRevenue, etc.)
 *   and pass it to the admin.dashboard view.
 */
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin.dashboard', [AdminDashboardController::class, 'index'])
        ->name('admin.dashboard');
});

// Requires the user to be authenticated and verified, calls update method to update data then edit method
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile.edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile.update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/subscribe', [ProfileController::class, 'subscribe'])->name('subscribe');
    Route::post('/unsubscribe', [ProfileController::class, 'unsubscribe'])->name('unsubscribe');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // The main admin dashboard
    Route::get('/admin.dashboard', [AdminDashboardController::class, 'index'])
        ->name('admin.dashboard');

    // Orders search
    Route::get('/orders', [AdminDashboardController::class, 'orders'])
        ->name('orders');

    // Users search
    Route::get('/users', [AdminDashboardController::class, 'users'])
        ->name('users');
});


// Requires the user to be authenticated and verified, calls update method to update data then edit method
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile.search', [ProfileController::class, 'search'])->name('profile.search');
    Route::get('/profile.editAdmin', [ProfileController::class, 'editAdmin'])->name('profile.editAdmin');
    Route::patch('/profile.updateAdmin', [ProfileController::class, 'updateAdmin'])->name('profile.updateAdmin');
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
Route::get('products.filter', [ProductsController::class, 'filter'])->name('products.filter');

// Blog routes
Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');

// Authenticated routes for creating/storing blog posts
Route::middleware(['auth'])->group(function () {
    Route::get('/blogs/create', [BlogController::class, 'create'])->name('blogs.create');
    Route::post('/blogs', [BlogController::class, 'store'])->name('blogs.store');
});

require __DIR__.'/auth.php';
