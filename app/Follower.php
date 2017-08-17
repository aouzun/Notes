<?php

namespace Notes;

use Illuminate\Database\Eloquent\Model;

use Notes\Department;
use Notes\Course;
use Notes\Section;

class Follower extends Model
{
	public static function find($type,$user_id,$id){
		return Follower::where('type', '=', $type)->where('user_id','=',$user_id)->where('followed_id','=',$id)->get();
	}

    public static function check($type,$user_id,$id){
		    	
    	return !self::find($type,$user_id,$id)->isEmpty();
    }


    public static function followedByUser($user_id){
    	$deps = Follower::where(['user_id' => $user_id, 'type' => 1])->get();
    	$crss = Follower::where(['user_id' => $user_id, 'type' => 2])->get();
    	$scts = Follower::where(['user_id' => $user_id, 'type' => 3])->get();
    	

    	$departments = array();
    	$courses = array();
    	$sections = array();
    	foreach($deps as $dep){
    		array_push($departments,Department::find($dep->followed_id));
    	}

    	foreach($crss as $crs){
    		array_push($courses,Course::find($crs->followed_id));
    	}
    	foreach($scts as $sct){
    		array_push($sections,Section::find($sct->followed_id));
    	}

    	

    	return compact(['departments','courses','sections']);
    }



}
