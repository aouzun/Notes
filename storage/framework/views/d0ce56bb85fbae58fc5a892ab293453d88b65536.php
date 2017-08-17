	
<?php $__env->startSection('content'); ?>
<div class = "container-fluid"> <p> Departments </p> </div>
<div class = "container-fluid text-center">
	<div class = "row">
		<div class = "col-md-2">
		    <ul  class="scrollable list-group">
		        <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dep): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		        <li class="list-group-item"> <a href="/<?php echo e($dep->slug_name); ?>/"> <?php echo e($dep->name); ?> </a> </li>
		        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		    </ul>
	    </div>

	    <div class = "col-md-8 thumbnail scrollable_Y">
	    	<div> Popular Departments </div>
	    	<br> 
	    	<div class = "row" >
	    		<?php $__currentLoopData = $popular_departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	    			<div class = "col-xs-4">
	    				<a href = "/<?php echo e($department->slug_name); ?>">
	    					<?php echo e($department->name); ?>

	    				</a>
	    			</div>
	    		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	    		<br> <br>
	    	</div>


	    </div>
	    	
	    <div class = "col-md-2"> 

	    	<ul class ="scrollable list-group">
				<li class = "list-group-item">
					<a href = "/add_department"> Add Department </a>
				</li>
			</ul>
	    </div>	
	</div>
	


</div>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>