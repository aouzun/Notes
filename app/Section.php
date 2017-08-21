<?php

namespace Notes;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
	public static function findByName($course_id,$section){
		return Section::where('slug_name','=',$section)->where('course_id','=',$course_id)->first();
	}

	public static function check($course_id,$section){
		$res = Section::where('slug_name','=',$section)->where('course_id','=',$course_id)->get();
		return !$res->isEmpty();
	}
	public static function findByCourse($course_id){
		return Section::where('course_id','=',$course_id)->get();
	}

	public static function getCreator($section_id){
        $log = Log::where([['changed_data','=','section'],['data_id','=',$section_id],['operation','=','add']])->get()->first();

        $user = User::find($log->user_id);
        
        $ret_val;
        $ret_val['id'] = $user->id;
        $ret_val['name'] = $user->name;

        return $ret_val;
        //dd(Log::where('changed_data','department')->where('data_id',$department_id)->where('operation','add')->get());
    }

}
