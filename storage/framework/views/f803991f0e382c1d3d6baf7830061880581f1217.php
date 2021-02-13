

<?php $__env->startSection('content'); ?>
<?php if(session('message')): ?>
	<div class="alert alert-info rounded-top rounded-right rounded-left rounded-bottom p-3">
		<?php echo e(session('message')); ?>

	</div>
<?php endif; ?>
<table class="table table-responsive table-inverse  table-hover text-center" width="100%">
	<thead>
		<tr>
			<th>Id</th>
			<th>Nombre</th>
			<th>Correo</th>
			<th>Tlfn</th>
			<th>Creado</th>
		
			<th colspan="2">Opciones</th>
		</tr>
	</thead>
	<tbody>
		<?php $__currentLoopData = $users->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr>
				<td><?php echo e($element->id); ?></td>
				<td><?php echo e($element->name); ?></td>
				<td><?php echo e($element->email); ?></td>
				<td><?php echo e($element->phone); ?></td>
				<td><?php echo e(date('d-m-Y H:i:s a',strtotime($element->created_at))); ?></td>
			
				
				<td>
					<a href="<?php echo e(route('eliminar user',[Crypt::encryptString($element->id)])); ?>" class="btn btn-danger font-weight-bold">Eliminar</a>
				</td>
			</tr>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</tbody>
</table>
<?php echo e($users->links()); ?>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.HeaderAdmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\TheSkinPower\resources\views/Admin/Users/admin.blade.php ENDPATH**/ ?>