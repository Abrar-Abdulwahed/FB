<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Services\AppSettingService;
use Symfony\Component\HttpFoundation\Response;

class AppLoginEnabling
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$option): Response
    {
        // option[
        //     0: 'facebook',
        //     1: 'google',
        // ]
        $settingService = app(AppSettingService::class);
        $facebookNotAllowedURLs = [
            route('app.login', 'facebook'),
            config('services.facebook.redirect'), 
        ];
        $googleNotAllowedURLs = [
            route('app.login', 'google'),
            config('services.google.redirect'),
        ];
        if($settingService->get($option[0].'_enable') == "off" && in_array(request()->url(),$facebookNotAllowedURLs)){
            abort(404);
        }
        if($settingService->get($option[1].'_enable') == "off" && in_array(request()->url(),$googleNotAllowedURLs)){
            abort(404);
        }
        return $next($request);
    }
}
