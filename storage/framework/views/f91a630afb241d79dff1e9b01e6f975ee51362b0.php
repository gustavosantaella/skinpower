

<?php $__env->startSection('content'); ?>
<?php if(session('message')): ?>
	<div class="alert alert-info rounded-top rounded-right rounded-left rounded-bottom p-3">
		<?php echo e(session('message')); ?>

	</div>
<?php endif; ?>
<table class="table table-responsive table-inverse  table-hover text-center">
	<thead>
		<tr>
			<th>Id</th>
			<th>Nombre</th>
			<th>Correo</th>
			<th>Tlfn</th>
			<th>Realizado</th>
			<th>Método</th>
			<th>Total</th>
			<th colspan="2">Opciones</th>
		</tr>
	</thead>
	<tbody>
		<?php $__currentLoopData = $list->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr>
				<td><?php echo e($element->id); ?></td>
				<td><?php echo e($element->nameuser); ?></td>
				<td><?php echo e($element->emailuser); ?></td>
				<td><?php echo e($element->phoneuser); ?></td>
				<td><?php echo e(date('d-m-Y H:i:s a',strtotime($element->creacion))); ?></td>
				<td><?php echo e($element->pay); ?></td>
				<td>$./<?php echo e($element->total); ?></td>
				<td>
					<a href="<?php echo e(route('ver venta',[Crypt::encryptString($element->id),Crypt::encryptString($element->nameuser)])); ?>" class="btn btn-primary font-weight-bold">Consultar</a>
				</td>
			</tr>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</tbody>
</table>
<?php echo e($list->links()); ?>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.HeaderAdmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\TheSkinPower\resources\views/Admin/sales/list.blade.php ENDPATH**/ ?>