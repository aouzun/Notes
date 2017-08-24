@extends('layouts.app',['title' => $section->name])

@section('content')


<div class = "container-fluid">
	<p> <a href = "{{FollowerHelper::findURL_D($department->id)}}"> {{$department->name}} </a>
		&gt
		<a href = "{{FollowerHelper::findURL_C($course->id)}}"> {{$course->name}} </a>
		&gt
		<a href = "{{FollowerHelper::findURL_S($section->id)}}"> {{$section->name}} </a>
	 </p>
</div>


<div class = "container-fluid text-center">

	<div class = "row">
		<div class = "col-md-2"> 
			<ul class ="scrollable list-group">
				<li class = "list-group-item">
					<a href = "{{FollowerHelper::findURL_S($section->id)}}"> Notes </a>
				</li>
				<li class = "list-group-item">
					<a href = "{{FollowerHelper::findURL_S($section->id)}}videos"> Videos </a>
				</li>
				
			</ul>
		</div>
		<div class="col-md-8 scrollable">
			<div class = "row">
				<div class = "">
					<div class ="col-md-12 thumbnail">
						<div class = "h3"> Section Info  </div>
						<div> {{$section->info}}  </div>
						<br> <br>
						<div class = "footer"> by <a href = "{{FollowerHelper::getProfileURL($user['id'])}}"> {{$user['name']}}</a> </div>
					</div> 
					
					@foreach($notes_path as $note_path)
						<div class = "thumbnail col-md-12">
							<a href = "{{URL::to('/')}}/storage/{{$note_path}}"> 
								<img src = "{{URL::to('/')}}/storage/{{$note_path}}">
							</a>
						</div>
					@endforeach
				</div>
			</div>
		</div>
		<div class = "col-md-2"> 
			<ul class ="scrollable list-group">
				<li class = "list-group-item">
					<button class = "btn-link" id="followbutton" onclick = "sendFollowRequest({{FollowerHelper::getUserID()}},3,{{$section->id}});">{{FollowerHelper::checkFollowed(3,FollowerHelper::getUserID(),$section->id)}}</button>
				</li>
				<li class = "list-group-item">
					<a href = "{{FollowerHelper::findURL_S($section->id)}}edit"> Edit </a>
				</li>
				<li class = "list-group-item">
					<a href = "{{FollowerHelper::findURL_S($section->id)}}add_note"> Add Note </a>
				</li>
			</ul>
		</div>
	</div>
	<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
</div>


<script src= "{{asset('js/ajax.js')}}"></script>
@endsection

