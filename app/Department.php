<?php

namespace Notes;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{

	protected $fillable = ['name','info'];    
    public static function check($department){
    	$res = Department::where('slug_name','=',$department)->get();
    	return !$res->isEmpty();
    }
	
    public static function findByName($department){
    	$res = Department::where('slug_name','=',$department)->first();
    	return $res;
    }

}
