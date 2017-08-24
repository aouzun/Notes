@extends('layouts.app',['title' => $section->name])

@section('content')


<div class = "container-fluid">
	<p> <a href = "{{FollowerHelper::findURL_D($department->id)}}"> {{$department->name}} </a>
		&gt
		<a href = "{{FollowerHelper::findURL_D($course->id)}}"> {{$course->name}} </a>
		&gt
		<a href = "{{FollowerHelper::findURL_D($section->id)}}"> {{$section->name}} </a>
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
		<div class="col-md-8">
			<div class = "row">
				<div class = "scrollable">
					<div class ="col-md-12 thumbnail">
						<div class = "h3"> Section Info  </div>
						<div> {{$section->info}}  </div>
						<br> <br>
						<div class = "footer"> by <a href = "{{FollowerHelper::getProfileURL($user['id'])}}"> {{$user['name']}}</a> </div>
					</div> 

					<div class = "thumbnail">
						<div class = "row">
							@if(count($videos))
								@foreach($videos as $video)
									<div class = "col-md-4 col-xs-4">
										<div class = "h4"> <a href = "https://www.youtube.com/watch?v={{$video->youtube_id}}"> {{$video->name}} </a> </div>
										<a href = "https://www.youtube.com/watch?v={{$video->youtube_id}}"> <img src = "https://img.youtube.com/vi/{{$video->youtube_id}}/mqdefault.jpg"> </a>
									</div>
								@endforeach
							@else
								<div class = "h3"> No videos are found. Would you like to <a href = "{{FollowerHelper::findURL_S($section->id)}}add_video"> add video? </a> </div>
							@endif
						</div>
						
					</div>

					


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
					<a href = "{{FollowerHelper::findURL_S($section->id)}}add_video"> Add Video </a>
				</li>
			</ul>
		</div>

		
	</div>
	<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
</div>


<script src= "{{asset('js/ajax.js')}}"></script>
@endsection

