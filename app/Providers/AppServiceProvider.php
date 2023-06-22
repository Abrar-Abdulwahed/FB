<?php

namespace App\Providers;

use App\Models\User;
use App\Mail\WelcomeUser;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Mail;
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
        User::created(function($user){
            Mail::to($user)->send(new WelcomeUser($user));
        });
    }
}
