<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
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
        // Use Bootstrap pagination instead of Tailwind
        Paginator::useBootstrap();

        // Register global Blade directive for image URLs
        Blade::directive('imageUrl', function ($expression) {
            return "<?php echo App\Helpers\ImageHelper::getImageUrl($expression); ?>";
        });
    }
}
