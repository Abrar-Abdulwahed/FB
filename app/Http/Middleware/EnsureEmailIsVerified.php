<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Services\AppSettingService;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified as BaseEnsureEmailIsVerified;

class EnsureEmailIsVerified extends BaseEnsureEmailIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $redirectToRoute = null)
    {
        $settingService = app(AppSettingService::class);
        if($settingService->get('email_confirm_enable') === 'on'){
            return parent::handle($request, $next, $redirectToRoute);
        }
        return $next($request);
    }
}
