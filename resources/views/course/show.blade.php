@extends('layouts.app')
@section('content')


<div class = "container-fluid">
	<span> 
		<p> <a href = "{{FollowerHelper::findURL_D($department->id)}}"> {{ $department->name }} </a> 
		&gt
		<a href = "{{FollowerHelper::findURL_C($course->id)}}"> {{$course->name}} </a> </p>
	</span>
</div>

<div class = "container-fluid text-center">
	<div class = "row">
		<div class = " col-md-2"> 
			<ul class = "scrollable list-group">
				@foreach ($sections as $section)
	            	<li class="list-group-item"> <a href="{{FollowerHelper::findURL_S($section->id)}}"> {{$section->name}} </a> </li>
	            @endforeach
			</ul>

		</div>

		<div class = "col-md-8">
			<div class = "thumbnail">
				<div class = "h3">  Course Info </div>
				<div> {{$course->info}} </div>
			</div>
			@if(count($popular_sections))
			<div class = "thumbnail">
	    		<div class ="fixed">
			    	<div class = "h3"> Popular Section </div>
	    		</div>
	    		<br> 
	    		<div class ="row">
	    			<div class = "scrollable_Y">
	    				@foreach($popular_sections as $section)
			    			<div class = "col-xs-4">
			    				<a href = "{{FollowerHelper::findURL_S($section->section_id)}}">
			    					{{$section->name}}
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
			    	<div class = "h3"> New Section </div>
	    		</div>
	    		<br> 
	    		<div class ="row">
	    			<div class = "scrollable_Y">
	    				@if(count($new_sections))
		    				@foreach($new_sections as $section)
				    			<div class = "col-xs-4">
				    				<a href = "{{FollowerHelper::findURL_S($section->id)}}">
				    					{{$section->name}}
				    				</a>
				    			</div>
				    		@endforeach
				    		<br><br>
			    		@else
			    			<div class = "col-xs-4 h4">
			    				No sections are found. Would you like to <a href = "{{FollowerHelper::findURL_C($course->id)}}add_section"> add section </a> ?
			    			</div>	
			    		@endif
	    			</div>
	    		</div>


	    	</div>

		</div>



		
			<div class = "col-md-2"> 
				<ul class =" scrollable list-group">
					<li class = "list-group-item">
	    				<button class = "btn-link" id="followbutton" onclick = "sendFollowRequest({{FollowerHelper::getUserID()}},2,{{$course->id}});">{{FollowerHelper::checkFollowed(2,FollowerHelper::getUserID(),$course->id)}}</button>
					</li>
					<li class = "list-group-item">
						<a href = "{{FollowerHelper::findURL_C($course->id)}}edit"> Edit </a>
					</li>
					<li class = "list-group-item">
						<a href = "{{FollowerHelper::findURL_C($course->id)}}add_section"> Add Section </a>
					</li>
				</ul>
			</div>
		</div>	
	</div>
	<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">


</div>

<script src= "{{asset('js/ajax.js')}}"></script>

@endsection