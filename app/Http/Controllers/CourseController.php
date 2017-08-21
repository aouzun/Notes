<?php

namespace Notes\Http\Controllers;

use Notes\Http\Middleware\Logger;
use Notes\Course;
use Notes\Department;
use Notes\Section;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

use FollowerHelper;

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
            $department = Department::findByName($department);
            return view('course.add',compact('department'));
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
        $department = Department::findByName($request->input('departmentSlug'));

        $course_name = $request->input('name');
        $course = new Course;
        $course->name = $course_name;
        $course->slug_name = $request->input('slug_name');
        $course->info = $request->input('info');
        $course->department_id = $department->id;
        $course->save();
        Storage::disk('public')->makeDirectory($department->slug_name.'/'.$course->slug_name);
        // Create a folder in /department_name/ named course_name
        $id = $course->id;
        Logger::handle($request,$id);

        return redirect('/' . $department->slug_name . '/' . $course->slug_name . '/');
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
                $course = Course::findByName($dep->id,$course);
                $sections = Section::findByCourse($course->id);
                $department = $dep;

                $popular_sections = FollowerHelper::findPopularSections($course->id);
                $new_sections = FollowerHelper::findNewSections($course->id);

                $user = Course::getCreator($course->id);
                return view('course.show',compact(['department','course','sections','popular_sections','new_sections','user']));
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
    public function edit($_department,$_course)
    {
        $department = Department::findByName($_department);
        $course = Course::findByName($department->id,$_course);
        return view('course.edit',compact(['department','course']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Notes\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$_department,$_course)
    {
        $new_name = $request->input('name');
        $dep_id = $request->input('department_id');
        if(Course::check($dep_id,$new_name) && $new_name != $_course){
            $error = $new_name . ' already exists.';
            return view('/error',compact('error'));
        }

        $flag = ($_course != $request->input('name'));

        
        $course = Course::findByName($dep_id,$_course);
        $old_name = $_course;
        $new_name = $request->input('name');

        $old_text = $course->info;
        $new_text = $request->input('info');

        $old_slug = $course->slug_name;
        $new_slug = $request->input('slug_name');

        $course->name = $new_name;
        $course->info = $new_text;
        $course->slug_name = $new_slug;
        $tmp = Department::find($dep_id)->slug_name;
        if ($flag) {
           
            $old_path = $tmp . '/' . $old_slug;
            $new_path = $tmp . '/' . $new_slug;
            Storage::disk('public') -> move($old_path,$new_path);
        }

        $course->save();

        $id = $course->id;

        Logger::handle($request,$id);

        return redirect('/'. $tmp . '/' . $course->slug_name);
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
