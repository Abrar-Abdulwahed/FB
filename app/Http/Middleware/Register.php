<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class Register
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $notAllowedURLs = url('register'); // add the register URL with the POST method

        if(Setting::where('name', 'register_enable')->first()?->value === 'off' &&  request()->url() === $notAllowedURLs && !Route::is('register')){
            return abort(404);
        }
        return $next($request);
    }
}
