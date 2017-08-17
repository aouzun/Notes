@extends('layouts.app')
@section('content')


<div class = "container-fluid">
	<span> 
		<p> <a href = "/{{$department->slug_name}}"> {{ $department->name }} </a> 
		&gt
		<a href = "/{{$department->slug_name}}/{{$course->slug_name}}"> {{$course->name}} </a> </p>
	</span>
</div>

<div class = "container-fluid text-center">
	<div class = "row">
		<div class = " col-md-2"> 
			<ul class = "scrollable list-group">
				@foreach ($sections as $section)
	            	<li class="list-group-item"> <a href="/{{$department->slug_name}}/{{$course->slug_name}}/{{$section->slug_name}}"> {{$section->name}} </a> </li>
	            @endforeach
			</ul>

		</div>

		<div class="col-md-8"> {{ $course->info }}</div>
			<div class = "col-md-2"> 
				<ul class =" scrollable list-group">
					<li class = "list-group-item">
	    				<button class = "btn-link" id="followbutton" onclick = "sendFollowRequest({{Auth::user()->id}},2,{{$course->id}});">{{FollowerHelper::checkFollowed(2,Auth::user()->id,$course->id)}}</button>
					</li>
					<li class = "list-group-item">
						<a href = "/{{$department->slug_name}}/{{$course->slug_name}}/edit"> Edit </a>
					</li>
					<li class = "list-group-item">
						<a href = "/{{$department->slug_name}}/{{$course->slug_name}}/add_section"> Add Section </a>
					</li>
				</ul>
			</div>
		</div>	
	</div>
	<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">


</div>

<script src= "{{asset('js/ajax.js')}}"></script>

@endsection