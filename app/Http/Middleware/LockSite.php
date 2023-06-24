<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
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
        // env('GOOGLE_REDIRECT'), env('FB_REDIRECT')
        $allowed = ['locked','login'];
        if(Setting::where('name', 'site_status')->first()?->value === 'inactive' && !in_array(Route::currentRouteName(),$allowed) && !Route::is('admin.*')){
            return redirect('/locked');
        }
        elseif(Setting::where('name', 'site_status')->first()?->value === 'active' && Route::is('locked')){
            return abort(404);
        }
        return $next($request);
    }
}
