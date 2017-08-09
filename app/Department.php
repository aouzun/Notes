<?php

namespace Notes;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    
    public static function check($department){
    	$res = Department::where('name','=',$department)->get();
    	return !$res->isEmpty();
    }
	
    public static function findByName($department){
    	$res = Department::where('name','=',$department)->first();
    	return $res;
    }

}
