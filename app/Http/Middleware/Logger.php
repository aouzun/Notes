<?php

namespace Notes\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Notes\Log;
use Notes\Course;
use Notes\Department;
use Notes\Section;
class Logger
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public static function handle($request,$id)
    {
        $operation = $request['operation'];
        if($operation == 'alter'){
            
            self::handleAlter($request,$id);
        }
        else if($operation == 'add'){
            self::handleAdd($request,$id);
        }
        else if($operation == 'delete'){

        }
    }


    private static function handleAdd($request,$id){
        $c_d = $request['changed_data'];
        
        // Check duplicate
        if($c_d == 'department'){

            $dep_name = $request->input('name');
            $name = $dep_name;
        }
        else if($c_d == 'course'){
            $dep_name = $request->input('departmentSlug');
            $crs_name = $request->input('name');
            $dep = Department::findByName($dep_name);
            $name = $crs_name;
        }
        else if($c_d == 'section'){
            $dep_name = $request->input('departmentSlug');
            $crs_name = $request->input('courseSlug');
            $sct_name = $request->input('name');
            $dep = Department::findByName($dep_name);
            $crs = Course::findByName($dep->id,$crs_name);
            $name = $sct_name;
        }
        else if($c_d == 'note'){
            $name = $request['name'];
            $info = null;
        }

        else if($c_d == 'video'){
            $name = $request['name'];
            $info = null;
        }

        $log = new Log;
        $info = $request['info'];
        $log->user_id = Auth::id();
        $log->operation = 'add';
        $log->changed_data = $c_d;
        $log->new_name = $name;
        $log->new_text = $info;
        $log->data_id = $id;
        $log->save();
        
    }

    private static function handleAlter($request,$id){
        $c_d = $request->input('changed_data');

        $old_name = $request->input('old_name');
        $old_info = $request->input('old_text');
        $new_name = $request->input('name');
        $new_info = $request->input('info');

        $log = new Log;

       

        $log->user_id = Auth::id();
        $log->operation = 'alter';
        $log->changed_data = $c_d;
        $log->new_name = $new_name;
        $log->new_text = $new_info;
        $log->old_name = $old_name;
        $log->old_text = $old_info;
        $log->data_id = $id;
        $log->save();


    }   


}
