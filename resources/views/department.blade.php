@extends('layouts.app')
@section('content')	
	<div class = "container-fluid">
			<p> <a href = "/{{$department->name}}"> {{$department->name}} </a> </p>
		</div>
	<div class = "container-fluid row text-center">
		<div class = " col-md-2"> 
			<ul class = "scrollable list-group">
				@foreach ($courses as $course)
	            	<li class="list-group-item"> <a href="/{{$department->name}}/{{$course->name}}/"> {{$course->name}} </a> </li>
	            @endforeach
			</ul>

		</div>
		
		<div class="col-md-8"> 
			<div class = "container">
				{{ $department->info }}
			</div>

		</div>


		<div class = "col-md-2"> 

	    	<ul class ="scrollable list-group">
				<li class = "list-group-item">
					<a href = "/{{$department->name}}/add_course"> Add Course </a>
				</li>
			</ul>
    	</div>
	</div>
	
	

	
@endsection