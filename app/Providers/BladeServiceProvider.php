<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //inja baraxe hame chi yni bayd to tag php az directive haye dige bdon @ estfade koni
        blade::directive('admin', function () {
            return "<?php if (auth()->user()->isSuperUser == 1 || auth()->user()->isAdmin == 1) : ?>"; // directive of 'Admin' middleware for blade
        });
        blade::directive('endadmin', function () {
            return "<?php endif; ?>"; // directive of 'Admin' middleware for blade
        });

        blade::directive('superuser', function () {
            return "<?php if (auth()->user()->isSuperUser == 1) : ?>"; // directive of 'Admin' middleware for blade
        });
        blade::directive('endsuperuser', function () {
            return "<?php endif; ?>"; // directive of 'Admin' middleware for blade
        });
    }
}
