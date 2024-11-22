<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware(['web', 'throttle:app'])
                ->group(base_path('routes/web.php'));

            Route::middleware(['web', 'admin', 'auth'])
                ->prefix('admin')
                ->name('admin.')
                ->group(base_path('routes/admin.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('app', function (Request $request) {

            if (Auth::check()) {
                return  $request->user()->isSuperUser() ||  $request->user()->isAdmin()
                    ? Limit::perMinutes(1, 40)->by($request->user()?->id ?: $request->ip())
                    : Limit::perMinutes(1, 20)->by($request->user()?->id ?: $request->ip());
            } else {
                return Limit::perMinutes(1, 20)->by($request->user()?->id ?: $request->ip());
            }
        });
    }
}
