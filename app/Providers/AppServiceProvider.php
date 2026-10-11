<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\URL;
use App\Helpers\ImageHelper;

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
        // The production proxy terminates TLS; keep plain http for local development.
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        Paginator::defaultView('vendor.pagination.sawah');
        Paginator::defaultSimpleView('vendor.pagination.sawah');

        // Register global Blade directive for image URLs
        Blade::directive('imageUrl', function ($expression) {
            return "<?php echo App\Helpers\ImageHelper::getImageUrl($expression); ?>";
        });
    }
}
