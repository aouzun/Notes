<?php $__env->startSection('content'); ?>	
	<div class = "container-fluid">
			<p> <a href = "/<?php echo e($department->name); ?>"> <?php echo e($department->name); ?> </a> </p>
		</div>
	<div class = "container-fluid row text-center">
		<div class = " col-md-2"> 
			<ul class = "scrollable list-group">
				<?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	            	<li class="list-group-item"> <a href="/<?php echo e($department->name); ?>/<?php echo e($course->name); ?>/"> <?php echo e($course->name); ?> </a> </li>
	            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</ul>

		</div>
		
		<div class="col-md-8"> 
			<div class = "container">
				<?php echo e($department->info); ?>

			</div>

		</div>


		<div class = "col-md-2"> 

	    	<ul class ="scrollable list-group">
				<li class = "list-group-item">
					<a href = "/<?php echo e($department->name); ?>/add_course"> Add Course </a>
				</li>
			</ul>
    	</div>
	</div>
	
	

	
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>