@extends('layouts.app',['title' => $department->name])

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
		<div class = "col-md-8">
			<div class = "thumbnail">
				<div class = "h3">  Department Info </div>
				<div> {{$department->info}} </div>
				<br><br>
				<div class = "footer"> by <a href = "{{FollowerHelper::getProfileURL($user['id'])}}"> {{$user['name']}} </a></div>
			</div>
			@if(count($popular_courses))
			<div class = "thumbnail">
	    		<div class ="fixed">
			    	<div class = "h3"> Popular Courses </div>
	    		</div>
	    		<br> 
	    		<div class ="row">
	    			<div class = "scrollable_Y">
	    				@foreach($popular_courses as $course)
			    			<div class = "col-xs-4">
			    				<a href = "{{FollowerHelper::findURL_C($course->course_id)}}">
			    					{{$course->name}}
			    				</a>
			    			</div>
			    		@endforeach
			    		<br><br>
	    			</div>
	    		</div>
	    	</div>
	    	@endif
	    	<div class = "thumbnail">
	    		<div class ="fixed">
			    	<div class = "h3"> New Courses </div>
	    		</div>
	    		<br> 
	    		<div class ="row">
	    			<div class = "scrollable_Y">
	    				@if(count($new_courses))
		    				@foreach($new_courses as $course)
				    			<div class = "col-xs-4">
				    				<a href = "{{FollowerHelper::findURL_C($course->id)}}">
				    					{{$course->name}}
				    				</a>
				    			</div>
				    		@endforeach
				    		<br><br>
			    		@else
			    			<div class = "col-xs-4 h4">
			    				No courses are found. Would you like to <a href = "{{FollowerHelper::findURL_D($department->id)}}add_course"> add course </a> ?
			    			</div>	
			    		@endif
	    			</div>
	    		</div>


	    	</div>

		</div>
		

		<div class = "col-md-2"> 

	    	<ul class ="scrollable list-group">
	    		<li class = "list-group-item">
	    			<button class = "btn-link" id="followbutton" onclick = "sendFollowRequest({{FollowerHelper::getUserID()}},1,{{$department->id}});">{{FollowerHelper::checkFollowed(1,FollowerHelper::getUserID(),$department->id)}}</button>
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