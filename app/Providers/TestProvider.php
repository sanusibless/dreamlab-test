<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\ProductController;

class TestProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->when(ProductController::class)
        ->needs('$string')
        ->give('Oh Lala');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
