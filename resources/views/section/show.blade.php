@extends('layouts.app')

@section('content')


<div class = "container-fluid">
	<p> <a href = "/{{$department->slug_name}}"> {{$department->name}} </a>
		&gt
		<a href = "/{{$department->slug_name}}/{{$course->slug_name}}"> {{$course->name}} </a>
		&gt
		<a href = "/{{$department->slug_name}}/{{$course->slug_name}}/{{$section->slug_name}}"> {{$section->name}} </a>
	 </p>
</div>


<div class = "container-fluid text-center">
	<div class = "row">
		<div class = " col-md-2"> 
		</div>
		<div class="col-md-8 row scrollable"> 
			<div> {{ $section->info }} </div>
			@foreach($notes_path as $note_path)
				<div class = "thumbnail col-md-12">
					<a href = "{{URL::to('/')}}/storage/{{$note_path}}"> 
						<img src = "{{URL::to('/')}}/storage/{{$note_path}}">
					</a>
				</div>
			@endforeach
		</div>
		<div class = "col-md-2"> 
			<ul class =" scrollable list-group">
				<li class = "list-group-item">
					<button class = "btn-link" id="followbutton" onclick = "sendFollowRequest({{Auth::user()->id}},3,{{$section->id}});">{{FollowerHelper::checkFollowed(3,Auth::user()->id,$section->id)}}</button>
				</li>
				<li class = "list-group-item">
					<a href = "/{{$department->slug_name}}/{{$course->slug_name}}/{{$section->slug_name}}/edit"> Edit </a>
				</li>
				<li class = "list-group-item">
					<a href = "/{{$department->slug_name}}/{{$course->slug_name}}/{{$section->slug_name}}/add_note"> Add Note </a>
				</li>
			</ul>
		</div>
	</div>
	<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

	

</div>


<script src= "{{asset('js/ajax.js')}}"></script>
@endsection

