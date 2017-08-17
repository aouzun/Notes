<?php

namespace Notes\Http\Middleware;

use Closure;
use Validator;
class FileValidator
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
        $input_data = $request->all();

        $validator = Validator::make(
            $input_data, [
            'name' => "required",
            'files.*' => 'mimes:jpg,png,jpeg'
            ],
            [   'files[]' => 'Files field cannot be empty.',
                'files.*' => 'Only jpg,png and jpeg are allowed']
        );
        
        if($validator->fails()){
            return redirect(url()->current())->withErrors($validator)->withInput();
        }
        
        return $next($request);
    }
}
