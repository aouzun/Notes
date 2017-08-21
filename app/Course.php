<?php

namespace Notes;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public static function findByDepartment($department_id){
    	return Course::where('department_id','=',$department_id)->get();
    }


    // Checks if the given course name already exists in the given department
    // Parameters
    // Department ID
    /// Course Name
    public static function check($department_id,$course_name){
        $res = Course::where('department_id',$department_id)->where('slug_name',$course_name)->get();
        return !$res->isEmpty();
    }

    public static function findByName($department_id,$course_name){
        return Course::where('department_id',$department_id)->where('slug_name',$course_name)->first();
    }

    public static function getCreator($course_id){
        $log = Log::where([['changed_data','=','course'],['data_id','=',$course_id],['operation','=','add']])->get()->first();

        $user = User::find($log->user_id);
        
        $ret_val;
        $ret_val['id'] = $user->id;
        $ret_val['name'] = $user->name;

        return $ret_val;
    }

}
