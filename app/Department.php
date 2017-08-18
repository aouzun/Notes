<?php

namespace Notes;

use Illuminate\Database\Eloquent\Model;

use Notes\Log as Log;

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

    public static function getCreator($department_id){
        $log = Log::where([['changed_data','=','department'],['data_id','=',$department_id],['operation','=','add']])->get()->first();

        $user = User::find($log->user_id);
        
        $ret_val;
        $ret_val['id'] = $user->id;
        $ret_val['name'] = $user->name;

        return $ret_val;
        //dd(Log::where('changed_data','department')->where('data_id',$department_id)->where('operation','add')->get());
    }

}
