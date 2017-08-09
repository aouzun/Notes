<?php

namespace Notes\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


use Notes\Department;

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
   	 	return view('main',compact('departments'));
    }
}
