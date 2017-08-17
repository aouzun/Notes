@extends('layouts.app')

@section('content')

<div class = "container-fluid">
		<p> <a href = "/{{$department->slug_name}}"> {{$department->name}} </a> </p>
	</div>
<div class = "container-fluid text-center" >
	<div class = "row">
		<div class = " col-md-2"> 
			<ul class = "scrollable list-group">
				@foreach ($courses as $course)
	            	<li class="list-group-item"> <a href="/{{$department->slug_name}}/{{$course->slug_name}}/"> {{$course->name}} </a> </li>
	            @endforeach
			</ul>

		</div>
		
		<div class="col-md-8"> 
			<div class = "row">
				<div class = "col-md-12 thumbnail">
					<div> Department Info </div>
					<div> {{$department->info}} </div>
				</div>
				<div class = "col-md-12 thumbnail">
					<div> Populer Courses in {{$department->name}} </div>
					<div class = row>
						<div class = "col-md-12 scrollable_Y">
							<div class = "row">
								@foreach($popular_courses as $course)
									<div class = "col-xs-4">
										<a href = "{{ FollowerHelper::findURL_C($course->course_id) }}"> 
											{{$course->name}}
										</a>
									</div>
								@endforeach
							</div>
							<br> <br>
						</div>
					</div>
				</div>

			</div>
		</div>

		<div class = "col-md-2"> 

	    	<ul class ="scrollable list-group">
	    		<li class = "list-group-item">
	    			<button class = "btn-link" id="followbutton" onclick = "sendFollowRequest({{Auth::user()->id}},1,{{$department->id}});">{{FollowerHelper::checkFollowed(1,Auth::user()->id,$department->id)}}</button>
				</li>
	    		<li class = "list-group-item">
					<a href = "/{{$department->slug_name}}/edit">Edit</a>
				</li>
				<li class = "list-group-item">
					<a href = "/{{$department->slug_name}}/add_course"> Add Course </a>
				</li>
			</ul>
		</div>	
	</div>
	
</div>

<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

<script src= "{{asset('js/ajax.js')}}"></script>


	
@endsection