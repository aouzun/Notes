@extends('layouts.app')
@section('content')


<div class = "container-fluid">
	<span> 
		<a href = "/{{$department}}"> {{ $department }} </a> 
		&gt
		<a href = "/{{$department}}/{{$course}}"> {{$course}} </a>
	</span>
</div>

<div class = "container-fluid row text-center">
	<div class = " col-md-1"> 
		
	</div>

	<div class="col-md-10"> {{ $course }}</div>
		<div class = "col-md-1"> 
			<ul class =" scrollable list-group">
				<li class = "list-group-item">
					<a href = "/{{$department}}/{{$course}}/add_note"> Add Note </a>
				</li>
			</ul>
		</div>
	</div>
</div>



@endsection