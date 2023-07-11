<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Services\AppSettingService;
use Symfony\Component\HttpFoundation\Response;

class FeatureEnabling
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $option): Response
    {
        $settingService = app(AppSettingService::class);
        if($settingService->get($option.'_enable') == "off"){
            abort(404);
        }
        return $next($request);
    }
}
