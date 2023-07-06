<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Spatie\Activitylog\ActivitylogServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->register(ActivitylogServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        if (Schema::hasTable('settings')) {
            $settings = Setting::all();
            foreach ($settings as $setting) {
                config()->set($setting['name'], $setting['value']);
            }

            $channels = ['daily'];

            if (app()->environment() == 'production') {
                if (Setting::where('name', 'telegram_report_enable')->first()?->value === "on") {
                    $channels[] = 'telegram';
                }
                if (Setting::where('name', 'slack_report_enable')->first()?->value === "on") {
                    $channels[] = 'slack';
                }
            }
            config()->set('logging.channels.stack.channels', $channels);
        }

    }
}
