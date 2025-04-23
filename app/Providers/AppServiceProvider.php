<?php

namespace App\Providers;

use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register the admin middleware
        Route::aliasMiddleware('admin', AdminMiddleware::class);

        // Share the authenticated user globally with Inertia
        Inertia::share([
    'auth' => [
        'user' => auth()->user() ? auth()->user() : null,  // Make sure it's always set to null if not logged in
    ],
]);
    }
}
