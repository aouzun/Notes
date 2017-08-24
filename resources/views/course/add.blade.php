@extends('layouts.app',['title' => 'Add Course'])
@section('content')

<div class ="container">
	<form class = "form-horizontal" method = "POST" action = "{{FollowerHelper::findURL_D($department->id)}}add_course">
		{{ csrf_field() }}	

		<div class = "form-group">
			<label for = "departmentName"> Department Name: </label>
			<input type="text" class="form-control" name="departmentName" value = "{{$department->name}}"   readonly="readonly" />
		</div>

		<div class="form-group">
			<label for="courseName">Course Name:</label>
			<input required type="text" class="form-control" id="name" name = "name">
		</div>

		<div class="form-group">
			<label for="departmentInfo">Info:</label>
			<textarea required class = "form-control" rows = "5" id = "info" name = "info"> </textarea>
			
		</div>
		<input hidden value="add" name="operation"/>
		<input hidden value="{{$department->slug_name}}" name="departmentSlug"/>
		<input hidden value="course" name = "changed_data" />
		<br>
		<button type="submit" class="btn btn-default">Submit</button>
	</form>
</div>



@endsection