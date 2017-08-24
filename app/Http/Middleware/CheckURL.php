<?php

namespace Notes\Http\Middleware;

use Closure;

class CheckURL
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
        $parameters = $request->route()->parameters();
        $name_from_user = $parameters['name'];
        $model = reset($parameters);
        if($model->slug_name == $name_from_user){
            return $next($request);
        }
        else{
            $error = "Invalid link";
            return redirect('/'); //('error',compact('error'));
        }

    }
}
