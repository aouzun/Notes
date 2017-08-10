<?php $__env->startSection('content'); ?>

<div class ="container">
	<form class = "form-horizontal" method = "POST" action = "/<?php echo e($department->name); ?>/<?php echo e($course->name); ?>/add_notes">
		<?php echo e(csrf_field()); ?>	
		<div class="form-group">
			<label for="departmentName">Department Name:</label>
			<input type="text" class="form-control" id="departmentName" readonly="readonly" name = "departmentName" value="<?php echo e($department->name); ?>" />
		</div>

		<div class = "form-group">
			<label for="courseName"> Course Name: </label>
			<input type="text" class="form-control" id ="courseName" readonly="readonly" name = "courseName" value ="<?php echo e($course->name); ?>" />
		</div>
		<div class = "form-group row">
			<div class = "col-md-5">
				<div class="form-group">
					<label for="contentTitle">Title: </label>
					<input type="text" class="form-control" id="titleName" name = "title" required="" />
				</div>
				<div class = "form-group">
				</div>
				<div class = "row">
					<div class = "col-md-4"> 
						<label class ="btn btn-default btn-block">
							Browse <input onchange="foo();" id="fileuploader" name = "file" type="file" style="display: none;" multiple>
						</label>
					</div>
					<div class = "col-md-4"> 
						<button type="submit" class="btn btn-default btn-block"> Submit</button>
					</div>
					<div class = "col-md-4">
						<a class = "btn btn-default btn-block" href = "/<?php echo e($department->name); ?>/<?php echo e($course->name); ?>"> Back </a>
					</div>
				</div>
			</div>	
			<div class = "col-md-2"> </div>	
			<div class = "row col-md-5 row" id = "files" style = "overflow: auto; max-height: 50vh;"> </div>
		</div>
		<div class = "form-group"></div>
		<div class="form-group row "></div>
	</form>

</div>


<script src="<?php echo e(asset('js/file.js')); ?>"  </script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>