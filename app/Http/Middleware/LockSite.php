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
        $allowedNames = ['locked', 'logout'];
        $allowedURLs = [
            route('app.login', 'facebook'),
            route('app.login', 'google'),
            config('services.facebook.redirect'), config('services.google.redirect'),
            route('login'), // add the login URL with the GET method
            url('login') // add the login URL with the POST method
        ];

        if(Setting::where('name', 'site_status')->first()?->value === 'inactive' && !in_array(request()->url(),$allowedURLs) && !in_array(Route::currentRouteName(),$allowedNames) && !Route::is('admin.*')){
            return redirect('/locked');
        }
        elseif(Setting::where('name', 'site_status')->first()?->value === 'active' && Route::is('locked')){
            return abort(404);
        }
        return $next($request);
    }
}
