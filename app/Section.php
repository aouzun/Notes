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

}
