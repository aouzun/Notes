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
    public function create(Department $department,$name)
    {
        if($department){
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
        dd(FollowerHelper::findURL_C($id));
        return redirect(FollowerHelper::findURL_C($id));
    }

    /**
     * Display the specified resource.
     *
     * @param  \Notes\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show (Course $course,$name){

        $department = Department::find($course->department_id);
        $sections = Section::findByCourse(($course->id));
        $popular_sections = FollowerHelper::findPopularSections($course->id);
        $new_sections = FollowerHelper::findNewSections($course->id);
        $user = Course::getCreator($course->id);
        return view('course.show',compact(['department','course','sections','popular_sections','new_sections','user']));



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Notes\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course, $name)
    {
        $department = Department::find($course->id);
        return view('course.edit',compact(['department','course']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Notes\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Course $course, $name)
    {
        $new_name = $request->input('name');
        $dep_id = $request->input('department_id');
        if(Course::check($dep_id,$new_name) && $new_name != $name){
            $error = $new_name . ' already exists.';
            return view('/error',compact('error'));
        }

        $flag = ($name != $request->input('name'));

        
        $course = Course::findByName($dep_id,$name);
        $old_name = $name;
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

        return redirect(FollowerHelper::findURL_C($course->id));
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
