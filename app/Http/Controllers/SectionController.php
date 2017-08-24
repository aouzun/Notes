<?php

namespace Notes\Http\Controllers;

use Notes\Http\Middleware\Logger;
use Notes\Section;
use Notes\Department;
use Notes\Course;
use Notes\Video;
use Notes\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Validator;
use FollowerHelper;
use Cocur\Slugify\Slugify;


class SectionController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        
        $name = $request->input('name');
        // Check if the title exists already
        $department = Department::findByName($request->input('departmentSlug'));
        $course = Course::findByName($department->id,$request->input('courseSlug'));
        if(Section::check($course->id,$name)){
            $error = $name . ' already exists.';
            return view('error',compact('error'));
        }

        $section = new Section;
        $section->name = $name;
        $section->slug_name = $request->input('slug_name');
        $section->course_id = $course->id;
        $section->info = $request->input('info');
        $section->save();

        $file_path = $department->slug_name . '/' . $course->slug_name . '/' . $section->slug_name . '/';
        Storage::disk('public')->makeDirectory($file_path);

        $department = $department->slug_name;
        $course = $course->slug_name;
        //$section = $title;

        $files = $request->allFiles();
        
        

        $id = $section->id;
        self::addNotes($id,$files);
        Logger::handle($request,$id);

        return redirect(FollowerHelper::findURL_S($id));
        
    }


    public static function addNotes($section_id,$files){
        $section = Section::find($section_id);
        $course = Course::find($section->course_id);
        $department = Department::find($course->department_id);

        $slug = new Slugify();
        $slug->activateRuleSet('turkish');
        $department = $department->slug_name;
        $course = $course->slug_name;
        foreach($files['files'] as $file){
            $note = new Note();
            $note->name = $file->getClientOriginalName();
            $index = strrpos($note->name,'.');

            $file_name = substr($note->name,0,$index);
            $file_name = $slug->slugify($file_name);

            $file_ext = substr($note->name,$index+1);

            $note->slug_name = $file_name . '.' . $file_ext;

            $note->section_id = $section->id;
            $file->storeAs($department.'/'.$course.'/'.$section->slug_name.'/',$note->slug_name,['disk' => 'public']);
            $note->save();
            $request = ['operation' => 'add', 'changed_data' => 'note', 'name' => $note->name, 'info' => null];
            Logger::handle($request,$note->id);
        }
    }

   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Course $course, $name)
    {

        $department = Department::find($course->department_id);


        return view('section.add',compact(['department','course']));
    }

    
    /**
     * Display the specified resource.
     *
     * @param  \Notes\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section,$name)
    {
        $course = Course::find($section->course_id);
        $department = Department::find($course->department_id);

        $res = array();
        $res['section'] = $section;
        $res['course'] = $course;
        $res['department'] = $department;

        if(!$res){
            $error = "Whoops";
            return view('error',compact('error'));
        }

        // Find path to load images
        $section = $res['section'];
        $file_path = FollowerHelper::findPATH_S($section->id);

        $notes = Note::findBySection($section->id);
        $notes_path = [];
        foreach($notes as $note){
            array_push($notes_path,$file_path . $note->slug_name);
        }

        $user = Section::getCreator($section->id);

        $res['notes_path'] = $notes_path;
        $res['user'] = $user;

        return view('section.show',$res);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Notes\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit(Section $section,$name)
    {
        $course = Course::find($section->course_id);
        $department = Department::find($course->department_id);




        return view('section.edit',compact(['department','course','section']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Notes\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Section $section,$name)
    {

        $new_slug = $request->input('slug_name');
        $old_slug = $request->input('old_slug');

        $old_name = $request->input('old_name');
        $old_info = $request->input('old_info');

        $new_name = $request->input('name');
        $new_info = $request->input('info');
        $crs_id = $request->input('course_id');
        $section = Section::findByName($crs_id,$new_slug);

        if(!is_null($section) && $section->slug_name == $old_slug){
            $error = $new_name . '/' . " already exists.";
            return view('error',compact('error'));
        }

        $section = Section::findByName($crs_id,$old_slug);
        $section->name = $new_name;
        $section->slug_name = $new_slug;
        $section->info = $new_info;

        $section->save();

        $course = Course::find($crs_id);
        $department = Department::find($course->department_id);


        $old_path = '/' . $department->slug_name . '/' . $course->slug_name . '/' . $old_slug . '/';
        $new_path = '/' . $department->slug_name . '/' . $course->slug_name . '/' . $new_slug . '/';
        Storage::disk('public')->move($old_path,$new_path);

        Logger::handle($request,$section->id);

        return redirect(FollowerHelper::findURL_S($section->id));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Notes\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Section $section)
    {
        //
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    public function show_videos(Section $section,$name){
        $res = array();
        $course = Course::find($section->course_id);
        $department = Department::find($course->department_id);

        $res['department'] = $department;
        $res['course'] = $course;
        $res['section'] = $section;
        if(!$res){
            $error = "Whoops";
            return view('error',compact('error'));
        }

        $videos = Video::findBySection($section->id);

        $user = Section::getCreator($section->id);

        $res['user'] = $user;
        $res['videos'] = $videos;
        return view('section.show_videos',$res);

    }


    public static function check($_department,$_course,$_section){
        $department = Department::findByName($_department);
        if(!$department){
            return [];
        }

        $course = Course::findByName($department->id,$_course);

        if(!$course){
            $error = "Course " . $_course . " does not exist.";
            return [];
        }
        $section = Section::findByName($course->id,$_section);


        if(!$section){

            $error = "Section " . $_section . " does not exist";
            return [];
        }


        return compact(['department','course','section']);

    }

}
