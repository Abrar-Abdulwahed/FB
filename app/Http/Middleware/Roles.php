<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Roles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login');
        }
        $userRoles = $user->roles()->pluck('name')->toArray();
        if (count(array_intersect($userRoles, $roles)) > 0) {
            return $next($request);
        }
        abort(403);
    }
}
