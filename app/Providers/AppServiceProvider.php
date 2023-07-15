<?php

namespace App\Providers;

use App\Models\Setting;
use Yajra\DataTables\Html\Builder;
use App\Services\AppSettingService;
use Illuminate\Support\Facades\App;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use App\Services\CustomMessageService;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Spatie\Activitylog\ActivitylogServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->register(ActivitylogServiceProvider::class);
        $this->app->singleton(AppSettingService::class, function ($app) {
            return new AppSettingService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
        Builder::useVite();
        if (Schema::hasTable('settings')) {
            $settingService = app(AppSettingService::class);
            view()->share('settingService', $settingService);
            foreach ($settingService->getAll() as $key => $value) {
                config()->set($key, $value);
            }

            $channels = ['daily'];
            if (app()->environment() == 'production') {
                if ($settingService->get('telegram_report_enable') === "on") {
                    $channels[] = 'telegram';
                }
                if ($settingService->get('slack_report_enable') === "on") {
                    $channels[] = 'slack';
                }
            }
            config()->set('logging.channels.stack.channels', $channels);

            Blade::if('feature', function ($feature) use ($settingService) {
                return $settingService->get($feature.'_enable') == 'on';
            });
        }

    }
}
