<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Config;
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
        Paginator::useBootstrap();

        if (Schema::hasTable('settings')) {
            $settings = Setting::all();
            foreach ($settings as $setting) {
                config()->set($setting['name'], $setting['value']);
            }

            //custom directives
            // Blade::directive('enableFeature', function($feature) use($settings) {
            //     return Setting::where('name', $feature)?->first()?->value == "on";
            // });
            
            //Event to send email for user
            // User::created(function($user){
            //     Mail::to($user)->send(new WelcomeUser($user));
            // });
        }

    }
}
