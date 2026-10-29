<?php

namespace App\Providers;

use App\Models\SiteSetting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

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
        // Set default pagination view
        Paginator::defaultView('vendor.pagination.default');

        // Share site settings globally across all Blade views
        View::composer('*', function ($view) {
            static $sharedSettings = null;

            if ($sharedSettings === null) {
                if (Schema::hasTable('site_settings')) {
                    $sharedSettings = SiteSetting::pluck('value', 'key')->toArray();
                } else {
                    $sharedSettings = [];
                }
            }

            $view->with('settings', $sharedSettings);
        });
    }
}
