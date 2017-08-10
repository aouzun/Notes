<?php $__env->startSection('content'); ?>


<div class = "container-fluid">
	<span> 
		<a href = "/<?php echo e($department); ?>"> <?php echo e($department); ?> </a> 
		&gt
		<a href = "/<?php echo e($department); ?>/<?php echo e($course); ?>"> <?php echo e($course); ?> </a>
	</span>
</div>

<div class = "container-fluid row text-center">
	<div class = " col-md-1"> 
		
	</div>

	<div class="col-md-10"> <?php echo e($course); ?></div>
		<div class = "col-md-1"> 
			<ul class =" scrollable list-group">
				<li class = "list-group-item">
					<a href = "/<?php echo e($department); ?>/<?php echo e($course); ?>/add_notes"> Add Notes </a>
				</li>
			</ul>
		</div>
	</div>
</div>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>