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
}
