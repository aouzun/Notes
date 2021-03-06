@extends('layouts.app',['title' => 'Add Section'])

@section('content')

<div class ="container">

	

	<form class = "form-horizontal" method = "POST" action = "{{FollowerHelper::findURL_C($course->id)}}add_section" enctype = "multipart/form-data">
		{{ csrf_field() }}	

		<div class = "form-group">
			@if ($errors->any())
		    	<div class="alert alert-danger">
		        	<ul>
		            	@foreach ($errors->all() as $error)
		                	<li>{{ $error }}</li>
		            	@endforeach
		        	</ul>
		    	</div>
			@endif
		</div>

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
					<label for="contentTitle">Section Name: </label>
					<input required type="text" class="form-control" id="titleName" name = "name" />
				</div>
				<div class="form-group">
					<label for="departmentInfo">Info:</label>
					<textarea required class = "form-control" rows = "5" id = "info" name = "info"> </textarea>
				</div>
				<div class = "form-group">
				</div>
				<div class = "row">
					<div class = "col-md-4"> 
						<button type="submit" class="btn btn-default btn-block"> Submit</button>
					</div>
					<div class = "col-md-4"> 
						<label class ="btn btn-default btn-block">
							Browse <input onchange="foo();" id="fileuploader" name = "files[]" type="file"  style="display: none;" multiple>
						</label>
					</div>
					<div class = "col-md-4">
						<a class = "btn btn-default btn-block" href = "{{FollowerHelper::findURL_C($course->id)}}"> Back </a>
					</div>
				</div>
			</div>	
			<div class = "col-md-2"> </div>	
			<div class = "row col-md-5 row" id = "filesBlock" style = "overflow: auto; max-height: 50vh;">
				<div class="form-group">
					<label for="files">Files: </label>
					
				</div>
			</div>
		</div>
		<div class = "form-group"></div>
		<div class="form-group row "></div>
		<input hidden name = "departmentSlug" value = "{{$department->slug_name}}"/>
		<input hidden name = "courseSlug" value ="{{$course->slug_name}}" />
		<input hidden value="add" name="operation"/>
		<input hidden value="section" name = "changed_data" />
	</form>

</div>


<script src="{{ asset('js/file.js') }}"  </script>


@endsection