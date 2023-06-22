<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Setting;
use App\Mail\WelcomeUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;
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

        // config()->set('recaptcha.api_site_key','test');
        $settings = Setting::all();
        // config(['RECAPTCHA_SITE_KEY'=> 'xxxx']);

        foreach($settings as $setting){
            config()->set($setting['name'],$setting['value']);
        }
        //Event to send email for user
        // User::created(function($user){
        //     Mail::to($user)->send(new WelcomeUser($user));
        // });
    
    }
}
