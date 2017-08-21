@extends('layouts.app',['title' => 'Add Notes to ' . $section->name])

@section('content')

<div class ="container">

	

	<form class = "form-horizontal" method = "POST" action = "{{FollowerHelper::findURL_S($section->id)}}add_video" enctype = "multipart/form-data">
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

		<div class = "form-group">
			<label for="courseName"> Section Name: </label>
			<input type="text" class="form-control" id ="courseName" readonly="readonly" name = "courseName" value ="{{$section->name}}" />
		</div>

		<div class = "form-group">
			<div class = "text-center">
				<div class = "row videos">
					<div class = "col-md-11 h3"> Link </div>
					<div clsas = "col-md-1"> </div>
					
					<div class = "col-md-10">
						<input type="text" class="form-control" name = "link[]" />
					</div>


					<div class = "col-md-1">
						<input type="button" class="form-control btn btn-default btn-primary" onclick = "addField();" value = "+"/>
					</div>
					<div class = "col-md-1">

						<input type="button" class = "btn btn-default btn-primary" onclick="submitClicked();" value = "Submit"/>
					</div>

				</div>
			</div>
		</div>
		<div class = "form-group"></div>
		<div class="form-group row "></div>
		<input hidden name = "titles[]"/>
		<input hidden name = "departmentSlug" value = "{{$department->slug_name}}"/>
		<input hidden name = "courseSlug" value ="{{$course->slug_name}}" />
		<input hidden name = "sectionSlug" value = "{{$section->slug_name}}" />
		<input hidden name = "id" value = "{{$section->id}}" />
		<input hidden value="add" name="operation"/>
		<input hidden value="note" name = "changed_data" />
	</form>

</div>


<script src = "{{asset('js/video.js')}}"> </script>

@endsection