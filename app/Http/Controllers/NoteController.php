<?php

namespace Notes\Http\Controllers;

use Notes\Note;
use Illuminate\Http\Request;
use Notes\Department;
use Notes\Course;
use Notes\Section;
use Notes\Http\Controllers\SectionController;
use FollowerHelper;
class NoteController extends Controller

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
    public function create(Section $section,$name){
        $course = Course::find($section->course_id);
        $department = Department::find($course->department_id);
        return view('section.add_note',compact(['department','course','section']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /*
        Request type
        departmentName
        courseName
        title
        file (files from client)
    */

    public function store(Request $request,Section $section,$name)
    {
        $section_id = $request->input('id');
        $files = $request->allFiles();
        SectionController::addNotes($section_id,$files);



        $course = Course::find($section->course_id);
        $department = Department::find($course->department_id);

        $path = '/' . $department->slug_name . '/' . $course->slug_name . '/' . $section->slug_name . '/';

        return redirect(FollowerHelper::findURL_S($section->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  \Notes\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Notes\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function edit(Note $note)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Notes\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Note $note)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Notes\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {
        //
    }
}
