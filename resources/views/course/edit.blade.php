@extends('layouts.app',['title' => 'Edit ' . $course->name])
@section('content')

<div class = "container">

	<form class = "form-horizontal" method = "POST" action = "{{FollowerHelper::findURL_C($course->id)}}edit">
		{{csrf_field()}}
		<div class="form-group">
			<label for="departmentName">Course Name:</label>
			<input required type="text" class="form-control" id="courseName" name = "name" value="{{$course->name}}" />
		</div>

		<div class="form-group">
			<label for="departmentName">Course Info:</label>
			<textarea required class="form-control" id="courseInfo" name = "info">{{$course->info}}</textarea>
		</div>

		<div class = "form-group row">
			
			<div class = "col-md-3"> </div>
			<div class = "col-md-3 text-center"> 
				<button type="submit" class="col-md-1 btn btn-default btn-block">Submit</button> 
			</div>
 			<div class = "col-md-3 text-center"> 
 				<a class = "col-md-1 btn btn-default btn-block" href = "{{FollowerHelper::findURL_C($course->id)}}">
 					Back
				</a> 
				
			</div> 
			<div class = "col-md-3"> </div>
		</div>

		<input hidden value="alter" name="operation"/>
		<input hidden value="course" name = "changed_data" />
		<input hidden value="{{$course->name}}" name="old_name" />
		<input hidden value="{{$course->info}}" name="old_text" />
		<input hidden value="{{$department->id}}" name = "department_id" />
		<input hidden value="{{$department->name}}" name = "department_name" />
	</form>

</div>

@endsection