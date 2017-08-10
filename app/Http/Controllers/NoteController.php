<?php

namespace Notes\Http\Controllers;

use Notes\Note;
use Illuminate\Http\Request;
use Notes\Department;
use Notes\Course;

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
    public function create($_department,$_course){
        $department = Department::findByName($_department);
        $course = Course::findByName($department->id,$_course);
        
        return view('add_notes',compact(['department','course']));
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

    public function store(Request $request)
    {
        dd($request->allFiles());
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
