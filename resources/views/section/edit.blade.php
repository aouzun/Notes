@extends('layouts.app')
@section('content')

<div class = "container">

	<form class = "form-horizontal" method = "POST" action = "/{{$department->slug_name}}/{{$course->slug_name}}/{{$section->slug_name}}/edit">
		{{csrf_field()}}
		<div class="form-group">
			<label for="sectionName">Section Name:</label>
			<input type="text" class="form-control" id="sectionName" name = "name" value="{{$section->name}}" />
		</div>

		<div class="form-group">
			<label for="sectionInfo">Section Info:</label>
			<input type="text" class="form-control" id="sectionInfo" name = "info" value="{{$section->info}}" />
		</div>

		<div class = "form-group row">
			
			<div class = "col-md-3"> </div>
			<div class = "col-md-3 text-center"> 
				<button type="submit" class="col-md-1 btn btn-default btn-block">Submit</button> 
			</div>
 			<div class = "col-md-3 text-center"> 
 				<a class = "col-md-1 btn btn-default btn-block" href = "/{{$department->slug_name}}/{{$course->slug_name}}/"> 
 					Back
				</a> 
				
			</div> 
			<div class = "col-md-3"> </div>
		</div>

		<input hidden value="alter" name="operation"/>
		<input hidden value="section" name = "changed_data" />
		<input hidden value="{{$section->slug_name}}" name = "old_slug" />
		<input hidden value="{{$section->name}}" name = "old_name" />
		<input hidden value="{{$section->info}}" name = "old_info" />
		<input hidden value="{{$course->id}}" name="course_id" />
	</form>

</div>

@endsection