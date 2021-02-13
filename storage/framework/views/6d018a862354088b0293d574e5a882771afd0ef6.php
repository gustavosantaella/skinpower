

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
	<?php if($errors->any()): ?>
	<div class="alert-danger rounded-top rounded-right rounded-left rounded-bottom p-3 font-weight-bold">
		<ul>
			<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<?php echo e($element); ?>

			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</ul>
	</div>
	<?php elseif(session('message')): ?>
	<div class="alert-info rounded-top rounded-right rounded-left rounded-bottom p-3 font-weight-bold">
		<?php echo e(session('message')); ?>

	</div>
	<?php endif; ?>
	<form method="POST" action="<?php echo e(route('editproduct')); ?>" enctype="multipart/form-data">
		<?php echo csrf_field(); ?>

		<fieldset class="form-group">
			<label for="exampleInputEmail1">Marca del producto</label>
			<input required="" type="text" pattern="^[a-zA-Z\s]{2,254}" class="val form-control val" id="exampleInputEmail1" required="" name="marca" value="<?php echo e($producto->brand); ?>" placeholder="Marca del producto...">
			<small class="text-muted">Por favor ingrese texto válido.</small>
		</fieldset>

		<fieldset class="form-group">
			<label for="exampleInputPassword1">Nombre del producto</label>
			<input required="" type="text" pattern="^[a-zA-Z\s]{2,254}" class="val form-control" id="exampleInputPassword1" required=" " name="nameproduct" value="<?php echo e($producto->nameproduct); ?>" placeholder="Nombre del producto...">
			<small class="text-muted">Por favor ingrese texto válido.</small>
		</fieldset>

		<fieldset class="form-group">
			<label for="exampleSelect1">¿Activo o Inactivo?</label>
			<select  required=""  class="val form-control" name="status" id="exampleSelect1">
				<option value="<?php echo e(($producto->status !=true)?0 : 1); ?>"><?php echo e(($producto->status !=true)?'Inactivo' : 'Activo'); ?></option>
				<option value=<?php echo e(TRUE); ?>>Activo</option>
				<option value=<?php echo e(0); ?>>Inactivo</option>

			</select>
			<small class="text-muted">Por favor escoja si desea que el producto se visualice en la página.</small>
		</fieldset>

	

		<fieldset class="form-group">
			<label for="exampleInputPassword1">Cantidad</label>
			<input required="" value="<?php echo e($producto->stock); ?>" min="1" pattern="." type="number" class="val form-control" id="exampleInputPassword1" required=" " name="cantidad" placeholder="Cantidad...">
			<small class="text-muted">Por favor ingrese la cantidad de productos que posee, este debe ser un numero entero.</small>
		</fieldset>

		<fieldset class="form-group">
			<label for="exampleInputPassword1">Precio del producto</label>
			<input required="" min="1" value="<?php echo e($producto->price); ?>" step="0.01" type="number" class="val form-control" id="exampleInputPassword1" required=" " name="precio" placeholder="Precio...">
		</fieldset>
		<input type="hidden" name="idproduct" value="<?php echo e(Crypt::encryptString($producto->idproduct)); ?>" placeholder="">
		<button type="submit" class="btn btn-primary">Enviar</button>
	</form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.HeaderAdmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\TheSkinPower\resources\views/Admin/products/edit.blade.php ENDPATH**/ ?>