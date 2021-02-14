

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
			<th>Foto</th>
			<th>Marca</th>
			<th>Nombre</th>
			<th>Precio</th>
			<th>Cantidad</th>
			<th>Status</th>
			<th>Creado</th>
		
			<th colspan="2">Opciones</th>
		</tr>
	</thead>
	<tbody>
		<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr>
				<td><?php echo e($element->idproduct); ?></td>
				<td><img src="<?php echo e(asset("img/DINAMIC/$element->photo")); ?>" width="100" height="100" alt="">	</td>
				<td><?php echo e($element->brand); ?></td>
				<td><?php echo e($element->nameproduct); ?></td>
				<td><?php echo e($element->price); ?></td>
				<td><?php echo e($element->stock); ?></td>
			<?php if(!$element->status): ?>
				<td><i class="fas fa-times-circle text-danger"> </i></td>
				<?php else: ?>
					<td><i class="fas fa-check text-success"> </i></td>
			<?php endif; ?>
				<td><?php echo e(date('d-m-Y H:i:s a',strtotime($element->created_at))); ?></td>
		
				<td>
					<a href="<?php echo e(route('eliminar producto',[Crypt::encryptString($element->idproduct)])); ?>" class="btn btn-danger font-weight-bold">Eliminar</a>
				</td>
				<td>
					<a href="<?php echo e(route('modificar producto',[Crypt::encryptString($element->idproduct)])); ?>" class="btn btn-warning font-weight-bold">Modificar</a>
				</td>
			</tr>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</tbody>
</table>

<?php echo e($products->links()); ?>


</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.HeaderAdmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\TheSkinPower\resources\views/Admin/products/list.blade.php ENDPATH**/ ?>