@extends('layouts.app',['title' => $user_name])

@section('content')


<div class = "container"> 

	<div class = "row">

		<div class = "col-md-12 h3 text-center"> {{$user_name}} </div>

		@if(count($departments))
		<div class = "col-md-12 thumbnail">
			<div class = "row">
				<div class = "col-md-12 h3"> Followed Departments </div>
				
					@foreach($departments as $department)
					<div class = "col-md-12 h4">
						<a href = "{{FollowerHelper::findURL_D($department->id)}}"> {{$department->name}} </a>
					</div>
					@endforeach
				
			</div>
		</div>
		@endif
		@if(count($created_departments))
		<div class = "col-md-12 thumbnail">
			<div class = "row">
				<div class = "col-md-12 h3"> Created Departments </div>
				
					@foreach($created_departments as $department)
					<div class = "col-md-12 h4">
						<a href = "{{FollowerHelper::findURL_D($department->department_id)}}"> {{$department->name}} </a>
					</div>
					@endforeach
				
			</div>
			
		</div>
		@endif
		@if(count($courses))
		<div class = "col-md-12 thumbnail">
			<div class = "row">
				<div class = "col-md-12 h3"> Followed Courses </div>
				@foreach($courses as $course)
					<div class = "col-md-12 h4">
						<a href = "{{FollowerHelper::findURL_C($course->id)}}"> {{$course->name}} </a>
					</div>
				@endforeach
			</div>
			
		</div>
		@endif
		@if(count($created_courses))
		<div class = "col-md-12 thumbnail">
			<div class = "row">
				<div class = "col-md-12 h3"> Created Courses </div>
				@foreach($created_courses as $course)
					<div class = "col-md-12 h4">
						<a href = "{{FollowerHelper::findURL_C($course->course_id)}}"> {{$course->name}} </a>
					</div>
				@endforeach
			</div>
			
		</div>
		@endif
		@if(count($sections))
		<div class = "col-md-12 thumbnail">
			<div class = "row">
				<div class = "col-md-12 h3"> Followed Sections </div>
				@foreach($sections as $section)
					<div class = "col-md-12 h4">
						<a href = "{{FollowerHelper::findURL_S($section->id)}}"> {{$section->name}} </a>
					</div>
				@endforeach
			</div>
			
		</div>
		@endif
		@if(count($created_sections))
		<div class = "col-md-12 thumbnail">
			<div class = "row">
				<div class = "col-md-12 h3"> Created Sections </div>
				@foreach($created_sections as $section)
					<div class = "col-md-12 h4">
						<a href = "{{FollowerHelper::findURL_S($section->section_id)}}"> {{$section->name}} </a>
					</div>
				@endforeach
			</div>
			
		</div>
		@endif
	</div>

</div>

@endsection