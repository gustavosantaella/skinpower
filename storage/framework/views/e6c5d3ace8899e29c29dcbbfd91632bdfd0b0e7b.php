
<?php $__env->startSection('content'); ?>
<?php
$total = 0;
$prdocut= [];

?>

<div class="container-fluid">
	<?php if(session('message')): ?>
	<div class="alert-info rounded-top rounded-right rounded-left rounded-bottom font-weight-bold p-3 mb-3">
		<?php echo e(session('message')); ?>

	</div>
	<?php elseif($errors->any()): ?>
	<ul>
		<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<div class="alert-danger rounded-top rounded-right rounded-left rounded-bottom p-3 mb-3 font-weight-bold">
			<li><?php echo e($error); ?></li>
		</div>	
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</ul>
	<?php endif; ?> 

	<div class="card ">
		<div class="card-body">
			<h4 class="card-title">Venta #<?php echo e($id); ?></h4>
			<h6 class="card-subtitle mb-2 text-muted"><?php echo e("$name"); ?></h6>

			<div class="card-body">
				<table class="table table-striped table-hover border-primary"  >

					<thead>
						<tr>
							<th width="20">Producto</th>
							<th width="20">Marca</th>
							<th width="20">Cantidad</th>
							<th width="20">Precio</th>
							<th width="20">Total</th>
						</tr>
					</thead>
					<tbody>

						<?php $__currentLoopData = $detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<form  action="<?php echo e(url('Cart/remove')); ?>" method="post">
							<?php echo csrf_field(); ?>

							<tr>
								<td width="20"> <?php echo e($value['nameproduct']); ?></td>
								<td width="05"><?php echo e($value['brand']); ?></td>
								<td hidden="">
									<?php echo e($product['product'][]=Crypt::encryptString($value['idproduct'])); ?>

									<?php echo e($product['nameProduct'][]=Crypt::encryptString($value['nameproduct'] )); ?>

									<?php echo e($product['price'][]=Crypt::encryptString($value['price'])); ?>

									<?php echo e($product['stock'][]=Crypt::encryptString($value['stock'])); ?>

									<?php echo e($product['brand'][]=Crypt::encryptString($value['brand'])); ?>

								</td>
								<td width="20"><?php echo e($value['stock']); ?></td>
								<td width="20">$./<?php echo e(number_format($value['price'],2,',','.')); ?></td>
								<td width="20">$./<?php echo e(number_format($value['price']*$value['stock'],2,',','.')); ?></td>


								

								<td hidden=""><?php echo e($total+=($value['price']*$value['stock'])); ?></td>
							</tr>
						</form>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
						<tr>
							<td colspan="4" class="text-right h3">Total</td>
							<td class="h3">$./<?php echo e(number_format($total,2,',','.')); ?></td>
						</tr>
					</tbody>
				</table>

			</div>
		</div>
	</div>
	
	<div class="">
		
		<br>
		<form action="<?php echo e(route('eliminar venta')); ?>" method="post" >
			<?php echo csrf_field(); ?>

			<?php for($i=0; $i<count($product['product']); $i++): ?>
			<div class="d-flex" hidden="">
				<input type="hidden" name="idproduct[]" value="<?php echo e($product['product'][$i]); ?>">
				<input type="hidden" name="stock[]" value="<?php echo e($product['stock'][$i]); ?>">
				<input type="hidden" name="idsale" value="<?php echo e(Crypt::encryptString($id)); ?>">




			</div>

			<?php endfor; ?>
			<button type="submit"  class="btn btn-danger font-weight-bold">Declinar</button>
		</form>


	</div>



</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.HeaderAdmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\TheSkinPower\resources\views/Admin/sales/view.blade.php ENDPATH**/ ?>