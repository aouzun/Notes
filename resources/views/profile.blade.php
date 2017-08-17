@extends('layouts.app')

@section('content')


<div class = "container"> 
	<div class = "row">
		<div class = "col-md-12 thumbnail">
			<div class = "row">
				<div class = "col-md-12 h1"> Followed Departments </div>
				
					@foreach($departments as $department)
					<div class = "col-md-12 h4">
						<a href = "{{FollowerHelper::findURL_D($department->id)}}"> {{$department->name}} </a>
					</div>
					@endforeach
				
			</div>
			
		</div>

		<div class = "col-md-12 thumbnail">
			<div class = "row">
				<div class = "col-md-12 h1"> Followed Courses </div>
				@foreach($courses as $course)
					<div class = "col-md-12 h4">
						<a href = "{{FollowerHelper::findURL_C($course->id)}}"> {{$course->name}} </a>
					</div>
				@endforeach
			</div>
			
		</div>

		<div class = "col-md-12 thumbnail">
			<div class = "row">
				<div class = "col-md-12 h1"> Followed Sections </div>
				@foreach($sections as $section)
					<div class = "col-md-12 h4">
						<a href = "{{FollowerHelper::findURL_S($section->id)}}"> {{$section->name}} </a>
					</div>
				@endforeach
			</div>
			
		</div>
	</div>
</div>

@endsection