<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Services\AppSettingService;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class LockSite
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $settingService = app(AppSettingService::class);
        $allowedNames = ['guest.locked', 'logout'];
        $allowedURLs = [
            route('app.login', 'facebook'),
            route('app.login', 'google'),
            config('services.facebook.redirect'), config('services.google.redirect'),
            route('login'), // add the login URL with the GET method
            url('login'), // add the login URL with the POST method
        ];
        if ($settingService->get('site_status') === 'inactive' 
            && !in_array(request()->url(), $allowedURLs) 
            && !in_array(Route::currentRouteName(), $allowedNames) 
            && !Route::is('admin.*')) {
            return redirect('/locked');
        } elseif ($settingService->get('site_status') === 'active' && Route::is('guest.locked')) {
            return abort(404);
        }
        return $next($request);
    }
}
