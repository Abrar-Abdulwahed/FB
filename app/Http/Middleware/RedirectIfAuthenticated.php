<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if (Auth::user()->roles->contains('name', 'admin')) {
                    return RouteServiceProvider::ADMIN_HOME;
                } else {
                    return RouteServiceProvider::HOME;
                }


                //return redirect()->back()->with('message','user is registerd');
                //TODO: check role and return to HOME for user and ADMIN_HOME for admins
                return redirect(RouteServiceProvider::ADMIN_HOME)->with('message','user is registerd');
            }
        }

        return $next($request);
    }
}
