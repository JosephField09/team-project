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
        // Pass the basket count to all views
        view()->composer('*', function ($view) {
            $basketCount = BasketController::getBasketCount();
            $view->with('basketCount', $basketCount);
        });
    }
}

