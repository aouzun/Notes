<?php $__env->startSection('content'); ?>

<div class ="container">
	<form class = "form-horizontal" method = "POST" action = "/<?php echo e($department); ?>/add_course">
		<?php echo e(csrf_field()); ?>	

		<div class = "form-group">
			<label for = "departmentName"> Department Name: </label>
			<input type="text" class="form-control" name="departmentName" value = "<?php echo e($department); ?>"   readonly="readonly" />
		</div>

		<div class="form-group">
			<label for="courseName">Course Name:</label>
			<input type="text" class="form-control" id="name" name = "name">
		</div>

		<div class="form-group">
			<label for="departmentInfo">Info:</label>
			<textarea class = "form-control" rows = "5" id = "info" name = "info"> </textarea>
			
		</div>
		<input hidden value="add" name="operation"/>
		<input hidden value="course" name = "changed_data" />
		<br>
		<button type="submit" class="btn btn-default">Submit</button>
	</form>
</div>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>