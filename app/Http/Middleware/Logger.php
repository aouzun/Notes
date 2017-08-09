<?php

namespace Notes\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Notes\Log;
use Notes\Course;
use Notes\Department;
class Logger
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
        $operation = $request->input('operation');
        $changed_d = $request->input('changed_data');
        if($changed_d == 'department'){
            if(Department::check($request->input('name'))){
                return $next($request);
            }
        }
        else if($changed_d == 'course'){
            $department = Department::findByName($request->input('departmentName'));
            $name = $request->input('name');
            if(Course::check($department->id,$name)){
                return $next($request);
            }
        }

        $log = new Log();
            
        $log->user_id = Auth::id();
        $log->operation = $request->input('operation');
        $log->changed_data = $request->input('changed_data');
        if($log->changed_data == "course"){
            $log->new_name = $request->input('departmentName') . '/' . $request->input('name');
        }
        else{
            $log->new_name = $request->input('name');
        }
        
        $log->new_text = $request->input('info');

        $log->save();

        return $next($request);
    }
}
