<?php

namespace Notes\Http\Controllers;

use Notes\Department;
use Notes\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        return view('add_department');
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
        if(Department::check($request->input('name'))){
            $error = "Department name already exists sad";
            return view('error',compact('error'));
        }
        else{
            Storage::disk('local')->makeDirectory($request->input('name'));
            $department = new Department;
            $department->name = $request->input('name');
            $department->info = $request->input('info');
            $department->save();    
            $courses = array();
            return redirect('/'.$department->name);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \Notes\Department  $department
     * @return \Illuminate\Http\Response
     */
    

    public function show($department){
        if(!Department::check($department)){
            $error = 'Department not found';
            return view('error',compact('error'));
        }
        $department = Department::findByName($department);
        $courses = Course::findByDepartment($department->id);
        return view('department',compact(['department','courses']));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Notes\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Notes\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        //
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
