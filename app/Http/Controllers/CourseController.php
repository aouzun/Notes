<?php

namespace Notes\Http\Controllers;

use Notes\Course;
use Notes\Department;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
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
    public function create($department)
    {
        if(Department::check($department)){
            return view('add_course',compact('department'));
        }
        else{
            $error = "Department " . $department . ' does not exist';
            return view('error',compact('error'));
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $department = Department::findByName($request->input('departmentName'));
        $course_name = $request->input('name');

        if(Course::check($department->id,$course_name)){
            $error = "Course already exists.";
            return view('error',compact('error'));
        }

        $course = new Course;
        $course->name = $course_name;
        $course->info = $request->input('info');
        $course->department_id = $department->id;
        $course->save();

        Storage::disk('local')->makeDirectory($department->name.'/'.$course_name);

        // Create a folder in /department_name/ named course_name

        $department = $department->name;
        return redirect('/' . $department . '/' . $course_name . '/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \Notes\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show ($department,$course){
        $dep = Department::findByName($department);
        if($dep){
            $flag = Course::check($dep->id,$course);
            if($flag){
                return view('course',compact(['department','course']));
            }
            else{
                $error = $course . " does not exist in " . $department;
            }
        }
        else{
            $error = "Department " . $department . " does not exist";
        }
        return view('error',compact('error'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Notes\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Notes\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Notes\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        //
    }
}
