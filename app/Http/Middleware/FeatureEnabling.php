<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Setting;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FeatureEnabling
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $route = $request->route()->getName();
        if(strpos($route, 'pages') !== false && Setting::where('name', 'page_status')->first()?->value == "off"){
            abort(404);
        }
        if(strpos($route, 'faqs') !== false && Setting::where('name', 'faq_status')->first()?->value == "off"){
            abort(404);
        }

        if(strpos($route, 'articles') !== false && Setting::where('name', 'article_status')->first()?->value == "off"){
            abort(404);
        }
        return $next($request);
    }
}
