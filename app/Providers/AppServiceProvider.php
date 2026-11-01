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
        require_once app_path('Helpers/helpers.php');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Pastikan aturan upload Livewire mengizinkan berkas besar hingga 150 MB (mendukung foto kamera resolusi tinggi & video)
        config([
            'livewire.temporary_file_upload.rules' => ['file', 'max:153600'],
            'livewire.temporary_file_upload.max_upload_time' => 30,
        ]);

        // Set default pagination view
        Paginator::defaultView('vendor.pagination.default');

        // Share site settings and active services globally across frontend Blade views with cache (skipping internal Filament views)
        View::composer(['pages.*', 'layouts.*', 'components.*', 'emails.*'], function ($view) {
            static $sharedSettings = null;
            static $sharedServices = null;

            if ($sharedSettings === null) {
                $sharedSettings = \Illuminate\Support\Facades\Cache::remember('nirwana_site_settings', 3600, function () {
                    if (Schema::hasTable('site_settings')) {
                        return SiteSetting::pluck('value', 'key')->toArray();
                    }
                    return [];
                });
            }

            if ($sharedServices === null) {
                $sharedServices = \Illuminate\Support\Facades\Cache::remember('nirwana_footer_services', 3600, function () {
                    if (Schema::hasTable('services')) {
                        return \App\Models\Service::where('is_active', true)->orderBy('order')->get(['id', 'title', 'slug']);
                    }
                    return collect();
                });
            }

            $view->with([
                'settings' => $sharedSettings,
                'footerServices' => $sharedServices,
            ]);
        });
    }
}
