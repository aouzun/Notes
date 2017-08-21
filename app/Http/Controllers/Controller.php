<?php

namespace Notes\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Cocur\Slugify\Slugify;
use Notes\Department;
use Notes\Follower;
use Notes\User;
use FollowerHelper;
use Auth;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function loginPage(){
    	return view("login");
    }

    public function registerPage(){
    	return view("register");
    }

    public function mainPage(){
    	$departments = Department::all();
      $popular_departments = FollowerHelper::findPopularDepartments();
      $new_departments = FollowerHelper::findNewDepartments();
   	 	return view('main',compact(['departments','popular_departments','new_departments']));
    }

    public function profilePage(User $user){
         
        $ret1 = Follower::followedByUser($user->id);
        $ret2 = FollowerHelper::getCreatedByUser($user->id);
        $ret3['user_name'] = $user->name;
        return view('profile',array_merge($ret1,$ret2,$ret3));
    }


    public function myProfilePage(){
      return self::profilePage(User::find(FollowerHelper::getUserID()));
    }


    public function follow(Request $request){

       $user_id = $request->input('user_id');
       $follower_type = $request->input('choice');
       $id = $request->input('id');
       
       $follower = Follower::find($follower_type,$user_id,$id);
       if($follower->isEmpty()){
            $follower = new Follower();
            $follower->type = $follower_type;
            $follower->user_id = $user_id;
            $follower->followed_id = $id;
            $follower->save();
       }
       else{
            $follower = $follower->first();
            $follower->delete();
       }
    }

    public function settingsPage(){

    }
}
