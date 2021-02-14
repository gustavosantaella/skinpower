

<?php $__env->startSection('content'); ?>

<?php if(session('message')): ?>
<div class="alert alert-info rounded-top rounded-right rounded-left rounded-bottom p-3">
	<?php echo e(session('message')); ?>

</div>
<?php endif; ?>
<div class="row">
	

	<div class="col-8">
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
					
				</tr>
			</thead>
			<tbody>
				<?php $__currentLoopData = $list->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td><?php echo e($element->idorder); ?></td>
					<td><?php echo e($element->name); ?></td>
					<td><?php echo e($element->email); ?></td>
					<td><?php echo e($element->phone); ?></td>
					<td><?php echo e(date('d-m-Y H:i:s a',strtotime($element->creacion))); ?></td>
					<td><?php echo e($element->pay); ?></td>
					<td>$./<?php echo e($element->total); ?></td>
				
			</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</tbody>
	</table>
	<?php echo e($list->links()); ?>



</div>


<div class="col-4">
	<div class="card">
		<div class="card-body text-justify">
			<div class="card-title h2">
				<p>Com&oacute; se cu&aacute;ndo se acept&oacute; mi pedido?</p>
			</div>	
			Una vez revisado el pedido, nos pondremos en cont&aacute;cto con usted. Luego de concretar el pago, el pedido se eliminara de su bandeja de <b>pedidos</b> automaticamente.	
		</div>
	</div>
</div>

</div>







</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.HeaderPage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\TheSkinPower\resources\views/Page/ordersList.blade.php ENDPATH**/ ?>