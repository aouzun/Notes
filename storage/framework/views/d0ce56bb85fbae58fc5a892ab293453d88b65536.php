<?php $__env->startSection('content'); ?>
<div class = "container-fluid"> <p> Departments </p> </div>
<div class = "container-fluid text-center">
	<div class = "row">
		<div class = "col-md-2 col-xs-12">
		    <ul  class="scrollable list-group">
		        <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dep): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		        <li class="list-group-item"> <a href="<?php echo e(FollowerHelper::findURL_D($dep->id)); ?>"> <?php echo e($dep->name); ?> </a> </li>
		        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		    </ul>
	    </div>


	    <div class = "col-md-8 col-xs-12">
	    	<div class = "thumbnail">
	    		<div class ="fixed">
			    	<div class = "h3"> Popular Departments </div>
	    		</div>
	    		<br> 
	    		<div class ="row">
	    			<div class = "scrollable_Y">
	    				<?php $__currentLoopData = $popular_departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			    			<div class = "col-md-4 col-xs-12">
			    				<a href = "<?php echo e(FollowerHelper::findURL_D($department->id)); ?>">
			    					<?php echo e($department->name); ?>

			    				</a>
			    			</div>
			    		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			    		<br><br>
	    			</div>
	    		</div>
	    	</div>
	    	<div class = "thumbnail">
	    		<div class ="fixed">
			    	<div class = "h3" > New Departments </div>
	    		</div>
	    		<br> 
	    		<div class ="row">
	    			<div class = "scrollable_Y">
	    				<?php $__currentLoopData = $new_departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			    			<div class = "col-md-4 col-xs-12">
			    				<a href = "<?php echo e(FollowerHelper::findURL_D($department->id)); ?>">
			    					<?php echo e($department->name); ?>

			    				</a>
			    			</div>
			    		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			    		<br><br>
	    			</div>
	    		</div>
	    	</div>
	    </div>

	    
	    	
	    <div class = "col-md-2 col-xs-12">

	    	<ul class ="scrollable list-group">
				<li class = "list-group-item">
					<a href = "/add_department"> Add Department </a>
				</li>
			</ul>
	    </div>	
	</div>
	


</div>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app',['title' => 'Notes'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>