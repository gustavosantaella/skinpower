
<?php if($errors->any()): ?>

<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
 <?php echo e($error); ?>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>

<?php if(session('mensaje')): ?>
 <?php echo e(session('mensaje')); ?>

<?php endif; ?>
<form action="<?php echo e(url('otro')); ?>" method="post">
	<?php echo csrf_field(); ?>
	<input type="text" name="hola" value="<?php echo e(old('hola')); ?>" placeholder="">
	<input type="submit" name="" value="enviar">
</form>

	<?php /**PATH C:\xampp\htdocs\TheSkinPower\resources\views/otro/prueba.blade.php ENDPATH**/ ?>