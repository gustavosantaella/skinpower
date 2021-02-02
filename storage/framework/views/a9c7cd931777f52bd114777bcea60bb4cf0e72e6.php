<?php $__env->startSection('content'); ?>
<?php
$total = 0;
$prdocut= [];
?>

<div class="container-fluid">
	<?php if(session('message')): ?>
	<div class="alert-<?php echo e(session('type')); ?> rounded-top rounded-right rounded-left rounded-bottom font-weight-bold p-3 mb-3">
		<?php echo e(session('message')); ?>

	</div>

	<?php elseif(!isset($_SESSION['name'])): ?>
	<div class="alert-warning rounded-top rounded-right rounded-left rounded-bottom font-weight-bold p-3 mb-3">
		Please Login <a href="<?php echo e(url('User/SignIn')); ?>" title="SignIn">here</a> to Order
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
	<?php if(isset($_SESSION['carrito'])): ?>

	<?php if(count($_SESSION['carrito'])>0): ?>
	<div class="card ">
		<div class="card-body">
			<h4 class="card-title">Your cart</h4>
			<h6 class="card-subtitle mb-2 text-muted"><?php echo e((isset($_SESSION['name']))?$_SESSION['name'] :null); ?></h6>

			<div class="card-body">
				<table class="table table-striped table-hover border-primary"  >

					<thead>
						<tr>
							<th width="25">Product</th>
							<th width="25">Brand</th>
							<th width="25">Stock</th>
							<th width="25">Price</th>
							<th width="25">Total</th>
							<th width="25">Opction</th>
						</tr>
					</thead>
					<tbody>

						<?php $__currentLoopData = $_SESSION['carrito']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<form  action="<?php echo e(url('Cart/remove')); ?>" method="post">
							<?php echo csrf_field(); ?>

							<tr>
								<td width="25"> <?php echo e($value['nameproduct']); ?></td>
								<td width="25"><?php echo e($value['brand']); ?></td>
								<td hidden=""><?php echo e($product['product'][]=Crypt::encryptString($value['idproduct'])); ?>

									<?php echo e($product['nameProduct'][]=Crypt::encryptString($value['nameproduct'] )); ?>

									<?php echo e($product['price'][]=Crypt::encryptString($value['price'])); ?>

									<?php echo e($product['stock'][]=Crypt::encryptString($value['stock client'])); ?>

								<?php echo e($product['brand'][]=Crypt::encryptString($value['brand'])); ?></td>
								<td width="25"><?php echo e($value['stock client']); ?></td>
								<td width="25">$./<?php echo e(number_format($value['price'],2,',','.')); ?></td>
								<td width="25">$./<?php echo e(number_format($value['price']*$value['stock client'],2,',','.')); ?></td>


								<td hidden=""><input type="hidden" readonly  required="" name="IdProduct" value="<?php echo e(Crypt::encryptString($value['idproduct'])); ?>" placeholder=""></td>
								<td width="25"><button type="submit" name="" class="btn btn-danger font-weight-bold">Delete</button></td>

								<td hidden=""><?php echo e($total+=($value['price']*$value['stock client'])); ?></td>
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
	<?php if(isset($_SESSION['name'])): ?>
	<form method="post" action="<?php echo e(url('Orders/addOrder')); ?>">
		<?php echo csrf_field(); ?>

		<h1>The order will be sent to:</h1>
		<small class="alert-info p-1 rounded-left rounded-right rounded-top rounded-bottom font-weight-bold">
		If the data is incorrect, please go to "My profile" and change the data.</small>


		<?php for($i=0; $i<count($product['product']); $i++): ?>
		<div class="d-flex" hidden="">
			<input type="hidden" name="product[]" value="<?php echo e($product['product'][$i]); ?>">
			<input type="hidden" name="price[]" value="<?php echo e($product['price'][$i]); ?>">
			<input type="hidden" name="stock[]" value="<?php echo e($product['stock'][$i]); ?>">
			<input type="hidden" name="nameProduct[]" value="<?php echo e($product['nameProduct'][$i]); ?>">
			<input type="hidden" name="brand[]" value="<?php echo e($product['brand'][$i]); ?>">

		</div>

		<?php endfor; ?>
		<input type="hidden" name="total" value="<?php echo e(Crypt::encryptString(number_format($total,2,',','.'))); ?>" placeholder="">
		<fieldset class="form-group">

			<label for="name">Name user</label>
			<input type="text" class="form-control" id="name" required="" name="name" readonly="" value="<?php echo e($_SESSION['name']); ?>">
		</fieldset>

		<fieldset class="form-group">
			<label for="email">Email</label>
			<input type="text" class="form-control" id="email" required="" name="email" readonly="" value="<?php echo e($_SESSION['email']); ?>">
		</fieldset>

		<fieldset class="form-group">
			<label for="phone">Phone number</label>
			<input type="tel" class="form-control" id="phone" name="phone" required="" readonly="" value="<?php echo e($_SESSION['phone']); ?>">
		</fieldset>

		<fieldset class="form-group">
			<h3>Pay method</h3> 
			<input type="radio" name="payMethod" required="" value="ZELLE" placeholder=""> ZELLE<br>
			<input type="radio" name="payMethod" required="" value="USD" placeholder=""> USD<br>
			<input type="radio" name="payMethod" required="" value="BS" placeholder=""> BS<br>
			<input type="radio" name="payMethod" required="" value="OTHER" placeholder=""> OTHER<br>
		</fieldset>
		<button type="submit" class="btn btn-primary font-weight-bold">Accept</button>
	</form>
	<?php endif; ?> 

	<?php else: ?>
	<div class="alert-warning rounded-top rounded-right rounded-left rounded-bottom font-weight-bold p-3">
		Empty cart!
	</div>
	<?php endif; ?>
	<?php else: ?>
	<div class="alert-warning rounded-top rounded-right rounded-left rounded-bottom font-weight-bold p-3">
		Empty cart!
	</div>

	<?php endif; ?> 
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.HeaderPage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/theskinpower/resources/views/Cart/Cart.blade.php ENDPATH**/ ?>