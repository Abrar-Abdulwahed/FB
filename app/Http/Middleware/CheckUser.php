<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // check if banned date finish 
        if (Carbon::now()->greaterThan(Auth::user()->banned_until)) {
            Auth::user()->update([
                'is_banned' => 0,
                'banned_until' => null,
            ]);
        }

        if (Auth::user()->is_banned) {
            return redirect('/error');
        } else {
            return $next($request);
        }
    }
}
