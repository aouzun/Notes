<?php $__env->startSection('content'); ?>


<div class = "container-fluid">
	<span> 
		<p> <a href = "/<?php echo e($department); ?>"> <?php echo e($department); ?> </a> 
		&gt
		<a href = "/<?php echo e($department); ?>/<?php echo e($course->name); ?>"> <?php echo e($course->name); ?> </a> </p>
	</span>
</div>

<div class = "container-fluid row text-center">
	<div class = " col-md-2"> 
		<ul class = "scrollable list-group">
			<?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            	<li class="list-group-item"> <a href="/<?php echo e($department); ?>/<?php echo e($course->name); ?>/<?php echo e($section->name); ?>"> <?php echo e($section->name); ?> </a> </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</ul>

	</div>

	<div class="col-md-8"> <?php echo e($course->info); ?></div>
		<div class = "col-md-2"> 
			<ul class =" scrollable list-group">
				<li class = "list-group-item">
					<a href = "/<?php echo e($department); ?>/<?php echo e($course->name); ?>/add_section"> Add Section </a>
				</li>
			</ul>
		</div>
	</div>
</div>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>