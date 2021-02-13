
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
			<h4 class="card-title">Pedido #<?php echo e($id); ?></h4>
			<h6 class="card-subtitle mb-2 text-muted"><?php echo e("$user->name $user->lastname"); ?></h6>

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
		<form method="post" action="<?php echo e(route('add ventas')); ?>">
			<?php echo csrf_field(); ?>

			<h1>Realizado por:</h1>

			<?php for($i=0; $i<count($product['product']); $i++): ?>
			<div class="d-flex" hidden="">
				<input type="hidden" name="product[]" value="<?php echo e($product['product'][$i]); ?>">
				<input type="hidden" name="price[]" value="<?php echo e($product['price'][$i]); ?>">
				<input type="hidden" name="stock[]" value="<?php echo e($product['stock'][$i]); ?>">
				<input type="hidden" name="nameProduct[]" value="<?php echo e($product['nameProduct'][$i]); ?>">
				<input type="hidden" name="brand[]" value="<?php echo e($product['brand'][$i]); ?>">
				<input type="hidden" name="idUser" value="<?php echo e(Crypt::encryptString($user->iduser)); ?>">
				<input type="hidden" name="idorder" value="<?php echo e(Crypt::encryptString($id)); ?>">

			</div>

			<?php endfor; ?>
			<input type="hidden" name="total" value="<?php echo e(Crypt::encryptString(number_format($total,2,',','.'))); ?>" placeholder="">
			<fieldset class="form-group">

				<label for="name">Nombre </label>
				<input type="text" class="form-control" id="name" required=""  readonly="" value="<?php echo e("$user->name $user->lastname"); ?>">

				<input type="hidden" class="form-control" id="name" required="" name="name" readonly="" value="<?php echo e(Crypt::encryptString("$user->name $user->lastname")); ?>">
			</fieldset>

			<fieldset class="form-group">
				<label for="email">Email</label>
				<input type="hidden" class="form-control" id="email" required="" name="email" readonly="" value="<?php echo e(Crypt::encryptString($user->email)); ?>">

				<input type="text" class="form-control" id="email" required=""  readonly="" value="<?php echo e($user->email); ?>">
			</fieldset>

			<fieldset class="form-group">
				<label for="phone">Teléfono</label>
				<input type="hidden" class="form-control" id="phone" name="phone" required="" readonly="" value="<?php echo e(Crypt::encryptString($user->phone)); ?>">

				<input type="tel" class="form-control" id="phone"  required="" readonly="" value="<?php echo e($user->phone); ?>">
			</fieldset>

			<fieldset class="form-group">
				<h3>Método de pago</h3> 

				<input type="text" disabled="" class="form-control"  value="<?php echo e($user->pay); ?>" placeholder="">
				<input type="hidden" required="" class="form-control" name="pay" value="<?php echo e(Crypt::encryptString($user->pay)); ?>" placeholder="">
			</fieldset>
			<button type="submit" class="btn btn-primary font-weight-bold">Aceptar</button>
		</form>
		<br>
		<form action="<?php echo e(route('eliminar')); ?>" method="post" >
			<?php echo csrf_field(); ?>

			<?php for($i=0; $i<count($product['product']); $i++): ?>
			<div class="d-flex" hidden="">
				<input type="hidden" name="idproduct[]" value="<?php echo e($product['product'][$i]); ?>">
				<input type="hidden" name="stock[]" value="<?php echo e($product['stock'][$i]); ?>">
				<input type="hidden" name="idorder" value="<?php echo e(Crypt::encryptString($id)); ?>">




			</div>

			<?php endfor; ?>
			<button type="submit"  class="btn btn-danger font-weight-bold">Declinar</button>
		</form>


	</div>



</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.HeaderAdmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\TheSkinPower\resources\views/Admin/orders/view.blade.php ENDPATH**/ ?>