<?php

namespace App\Providers;

use App\Models\App\Review;
use App\Models\Business\AdminActivity;
use App\Observers\AdminActivityObserver;
use App\Observers\ReviewNotificationObserver;
use App\Observers\ReviewResponseObserver;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

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
        // Blade directives
        Blade::directive('actualyear', function () {
            return "<?php echo (new \DateTime('now'))->format('Y'); ?>";
        });

        Blade::directive('now', function () {
            return "<?php echo (new \DateTime('now'))->format('m-d-Y'); ?>";
        });

        Blade::directive('currentfullname', function () {
            return "<?php echo currentUser()->fullName(); ?>";
        });

        Blade::withoutDoubleEncoding();

        AdminActivity::observe(AdminActivityObserver::class);
        Review::observe(ReviewNotificationObserver::class);
        Review::observe(ReviewResponseObserver::class);

        if (app()->environment('production')) {
            URL::forceScheme('https');
        }
    }
}
