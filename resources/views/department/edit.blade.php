@extends('layouts.app')
@section('content')	

<div class = "container">

	<form class = "form-horizontal" method = "POST" action = "/{{$department->slug_name}}/edit">
		{{csrf_field()}}
		<div class="form-group">
			<label for="departmentName">Department Name:</label>
			<input type="text" class="form-control" id="departmentName" name = "name" value="{{$department->name}}" />
		</div>

		<div class="form-group">
			<label for="departmentName">Department Info:</label>
			<input type="text" class="form-control" id="departmentInfo" name = "info" value="{{$department->info}}" />
		</div>

		<div class = "form-group row">
			
			<div class = "col-md-3"> </div>
			<div class = "col-md-3 text-center"> 
				<button type="submit" class="col-md-1 btn btn-default btn-block">Submit</button> 
			</div>
 			<div class = "col-md-3 text-center"> 
 				<a class = "col-md-1 btn btn-default btn-block" href = "/{{$department->slug_name}}/"> 
 					Back
				</a> 
				
			</div> 
			<div class = "col-md-3"> </div>
		</div>

		<input hidden value="alter" name="operation"/>
		<input hidden value="department" name = "changed_data" />
		<input hidden value="{{$department->name}}" name="old_name" />
		<input hidden value="{{$department->info}}" name="old_text" />
	</form>

</div>

@endsection