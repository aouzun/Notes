@extends('layouts.app')
@section('content')
<div class = "container-fluid"> <p> Departments </p> </div>
<div class = "container-fluid row text-center">
	<div class = "col-md-2">
	    <ul  class="scrollable list-group">
	        @foreach ($departments as $dep)
	        <li class="list-group-item"> <a href="/{{ $dep->name }}/"> {{$dep->name}} </a> </li>
	        @endforeach
	    </ul>
    </div>

    <div class = "col-md-8"> </div>

    <div class = "col-md-2"> 

    	<ul class ="scrollable list-group">
			<li class = "list-group-item">
				<a href = "/add_department"> Add Department </a>
			</li>
		</ul>
    </div>


</div>



@endsection
