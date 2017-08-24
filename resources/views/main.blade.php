@extends('layouts.app',['title' => 'Notes'])

@section('content')
<div class = "container-fluid"> <p> Departments </p> </div>
<div class = "container-fluid text-center">
	<div class = "row">
		<div class = "col-md-2 col-xs-12">
		    <ul  class="scrollable list-group">
		        @foreach ($departments as $dep)
		        <li class="list-group-item"> <a href="{{FollowerHelper::findURL_D($dep->id)}}"> {{$dep->name}} </a> </li>
		        @endforeach
		    </ul>
	    </div>


	    <div class = "col-md-8 col-xs-12">
	    	<div class = "thumbnail">
	    		<div class ="fixed">
			    	<div class = "h3"> Popular Departments </div>
	    		</div>
	    		<br> 
	    		<div class ="row">
	    			<div class = "scrollable_Y">
	    				@foreach($popular_departments as $department)
			    			<div class = "col-md-4 col-xs-12">
			    				<a href = "{{FollowerHelper::findURL_D($department->id)}}">
			    					{{$department->name}}
			    				</a>
			    			</div>
			    		@endforeach
			    		<br><br>
	    			</div>
	    		</div>
	    	</div>
	    	<div class = "thumbnail">
	    		<div class ="fixed">
			    	<div class = "h3" > New Departments </div>
	    		</div>
	    		<br> 
	    		<div class ="row">
	    			<div class = "scrollable_Y">
	    				@foreach($new_departments as $department)
			    			<div class = "col-md-4 col-xs-12">
			    				<a href = "{{FollowerHelper::findURL_D($department->id)}}">
			    					{{$department->name}}
			    				</a>
			    			</div>
			    		@endforeach
			    		<br><br>
	    			</div>
	    		</div>
	    	</div>
	    </div>

	    
	    	
	    <div class = "col-md-2 col-xs-12">

	    	<ul class ="scrollable list-group">
				<li class = "list-group-item">
					<a href = "/add_department"> Add Department </a>
				</li>
			</ul>
	    </div>	
	</div>
	


</div>



@endsection
