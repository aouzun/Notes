<?php $__env->startSection('content'); ?>

<p class = "text-center"> <?php echo e($error); ?> </p>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app',['title' => 'Error'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>