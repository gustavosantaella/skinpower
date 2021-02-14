
<?php $__env->startSection('content'); ?>

<h1>Cambiar datos del usuario</h1>
<?php if($errors->any()): ?>
<div class="alert alert-danger rounded-left rounded-right rounded-bottom rounded-top p-3 font-weight-bold">
	<ul>
		<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

		<li><?php echo e($element); ?>	</li>


		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</ul>
</div>
<?php elseif(session('message')): ?>
<div class="alert alert-info rounded-right rounded-top rounded-bottom rounded-left p-3 font-weight-bold">
	<?php echo e(session('message')); ?>

</div>
<?php endif; ?>
<div class="card">

	<div class="card-body">
		<form class="" method="POST" action="<?php echo e(url('User/Profile')); ?>">
			<?php echo csrf_field(); ?>

			<fieldset class="form-group">
				<label for="name">Primer nombre</label>
				<input type="text" class="form-control" id="name" required="" minlength="5" name="name" value="<?php echo e($user->name); ?>" placeholder="Name...">
			</fieldset>
			<fieldset class="form-group">
				<label for="lastname">Apellido</label>
				<input type="text" class="form-control" id="lastname" required="" minlength="5" name="lastname" value="<?php echo e($user->lastname); ?>" placeholder="Lastname...">
			</fieldset>

			<fieldset class="form-group">
				<label for="phone">N&uacute;mero de tel&eacute;fono</label>
				<input type="tel" class="form-control <?php if(isset($_SESSION['phone']) && $_SESSION['phone'] ==''): ?>
				border-danger
				<?php endif; ?>" id="phone"   minlength="13" min="13" max="13" maxlength="13" name="phone"value="<?php echo e($user->phone); ?>" placeholder="Phone...">
			</fieldset>
			<fieldset class="form-group">
				<input type="hidden" name="iduser" required="" value="<?php echo e(Crypt::encryptString($user->id)); ?>" placeholder="">
				<input type="submit" class="btn btn-primary font-weight-bold" value="Aceptar">
			</fieldset>
		</form>
	</div>
	
</div>

<div class="card mt-4">

	<div class="card-body">
		<div class="card-title h3 ">
			Cambiar correo electr&oacute;nico
		</div>
		<form action="<?php echo e(route('updateEmail')); ?>" method="POST" accept-charset="utf-8">
			<?php echo csrf_field(); ?>

			<fieldset class="form-group">
				<label for="email">Tu email</label>
				<input type="email" class="form-control" id="email"required=""  minlength="10" name="email" value="<?php echo e($user->email); ?>"placeholder="Email...">
			</fieldset>


			<fieldset class="form-group">
				<input type="hidden" name="iduser" required="" value="<?php echo e(Crypt::encryptString($user->id)); ?>" placeholder="">
				<input type="submit" class="btn btn-primary font-weight-bold" value="Aceptar">
			</fieldset>
		</form>
	</div>
	
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.HeaderPage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\TheSkinPower\resources\views/Users/update.blade.php ENDPATH**/ ?>