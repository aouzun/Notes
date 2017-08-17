<?php

namespace Notes\Http\Middleware;

use Closure;

use Cocur\Slugify\Slugify;

class Slug
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $slug = new Slugify();
        $slug->activateRuleSet('turkish');
        $request->merge(['slug_name' => $slug->slugify($request->input('name'))]);
        
        return $next($request);
    }
}
