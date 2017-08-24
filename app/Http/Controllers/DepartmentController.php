<?php

namespace Notes\Http\Controllers;

use Notes\Http\Middleware\Logger;
use Notes\Department;
use Notes\Course;
use Notes\Follower;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use FollowerHelper;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('department.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Check if there is a department with the same name
        if(Department::check($request->input('slug_name'))){
            $error = "Department name already exists sad";
            return view('error',compact('error'));
        }
        else{
            Storage::disk('public')->makeDirectory($request->input('slug_name'));
            $department = new Department;
            $department->name = $request->input('name');
            $department->info = $request->input('info');
            $department->slug_name = $request->input('slug_name');
            $department->save();    
            $courses = array();

            $id = $department->id;

            Logger::handle($request,$id);

            return redirect(FollowerHelper::findURL_D($id));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \Notes\Department  $department
     * @return \Illuminate\Http\Response
     */
    

    public function show(Department $department,$name)
    {
        if(Department::checkName($department,$name)){
            if($department){
                $courses = Course::findByDepartment($department->id);
                $popular_courses = FollowerHelper::findPopularCourses($department->id);
                $new_courses = FollowerHelper::findNewCourses($department->id);
                $user = (Department::getCreator($department->id));
                return view('department.show',compact(['department','courses','popular_courses','new_courses','user']));
            }
        }
        else{
            $error = 'Department not found';
            return view('error',compact('error'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Notes\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department,$name)
    {
        if(Department::checkName($department,$name)){
            return view('department.edit',compact('department'));
        }
        else{
            $error = 'Department not found';
            return view('error',compact('error'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Notes\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Department $department,$name)
    {

        $new_name = $request->input('name');
        $new_slug = $request->input('slug_name');
        if(Department::check($new_slug) && $name != $new_slug){
            $error = $new_name . ' already exists.';
            return view('/error',compact('error'));
        }

        $courses = Course::findByDepartment($department->id);

        $flag = ($department->name != $request->input('name'));
        $old_name = $department->name;
        $old_path = $department->slug_name;
        $new_path = $new_slug;
        $department->name = $new_name;
        $department->slug_name = $new_slug;
        $department->info = $request->input('info');
        $department->save();



        if($flag){
            Storage::disk('public')->move($old_path,$new_path);
        }

        $id = $department->id;
        Logger::handle($request,$id);


        return redirect(FollowerHelper::findURL_D($id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Notes\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        //
    }
}
