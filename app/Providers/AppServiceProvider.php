<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\BasketController;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Pass the basket count and categories to all views
        view()->composer('*', function ($view) {
            $basketCount = BasketController::getBasketCount();
            $categories = \App\Models\Category::all(); // Fetch all categories
            $view->with([
                'basketCount' => $basketCount,
                'categories' => $categories,
            ]);
        });
    }

}

