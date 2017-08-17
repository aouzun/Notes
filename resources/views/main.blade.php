@extends('layouts.app')	
@section('content')
<div class = "container-fluid"> <p> Departments </p> </div>
<div class = "container-fluid text-center">
	<div class = "row">
		<div class = "col-md-2">
		    <ul  class="scrollable list-group">
		        @foreach ($departments as $dep)
		        <li class="list-group-item"> <a href="/{{ $dep->slug_name }}/"> {{$dep->name}} </a> </li>
		        @endforeach
		    </ul>
	    </div>

	    <div class = "col-md-8 thumbnail scrollable_Y">
	    	<div> Popular Departments </div>
	    	<br> 
	    	<div class = "row" >
	    		@foreach($popular_departments as $department)
	    			<div class = "col-xs-4">
	    				<a href = "/{{$department->slug_name}}">
	    					{{$department->name}}
	    				</a>
	    			</div>
	    		@endforeach
	    		<br> <br>
	    	</div>


	    </div>
	    	
	    <div class = "col-md-2"> 

	    	<ul class ="scrollable list-group">
				<li class = "list-group-item">
					<a href = "/add_department"> Add Department </a>
				</li>
			</ul>
	    </div>	
	</div>
	


</div>



@endsection
