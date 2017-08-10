@extends('layouts.app')

@section('content')

<div class ="container">
	<form class = "form-horizontal" method = "POST" action = "/{{$department->name}}/{{$course->name}}/add_notes">
		{{ csrf_field() }}	
		<div class="form-group">
			<label for="departmentName">Department Name:</label>
			<input type="text" class="form-control" id="departmentName" readonly="readonly" name = "departmentName" value="{{$department->name}}" />
		</div>

		<div class = "form-group">
			<label for="courseName"> Course Name: </label>
			<input type="text" class="form-control" id ="courseName" readonly="readonly" name = "courseName" value ="{{$course->name}}" />
		</div>
		<div class = "form-group row">
			<div class = "col-md-5">
				<div class="form-group">
					<label for="contentTitle">Title: </label>
					<input type="text" class="form-control" id="titleName" name = "title" required="" />
				</div>
				<div class = "form-group">
				</div>
				<div class = "row">
					<div class = "col-md-4"> 
						<label class ="btn btn-default btn-block">
							Browse <input onchange="foo();" id="fileuploader" name = "file" type="file" style="display: none;" multiple>
						</label>
					</div>
					<div class = "col-md-4"> 
						<button type="submit" class="btn btn-default btn-block"> Submit</button>
					</div>
					<div class = "col-md-4">
						<a class = "btn btn-default btn-block" href = "/{{$department->name}}/{{$course->name}}"> Back </a>
					</div>
				</div>
			</div>	
			<div class = "col-md-2"> </div>	
			<div class = "row col-md-5 row" id = "files" style = "overflow: auto; max-height: 50vh;"> </div>
		</div>
		<div class = "form-group"></div>
		<div class="form-group row "></div>
	</form>

</div>


<script src="{{ asset('js/file.js') }}"  </script>


@endsection