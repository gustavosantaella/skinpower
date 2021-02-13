
<?php $__env->startSection('content'); ?>

<?php if(session('message')): ?>

	<div class="alert-<?php echo e(session('type')); ?> rounded-top rounded-right rounded-left rounded-bottom p-3 mb-3 font-weight-bold">
		<?php echo e(session('message')); ?>

	</div>
	<?php elseif($errors->any()): ?>

	<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<ul>
		

<div class="alert-danger rounded-top rounded-right rounded-left rounded-bottom p-3 mb-3 font-weight-bold">
		<li><?php echo e($error); ?></li>
	</div>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>

<?php elseif(!$products): ?>

<div class="alert-warning rounded-top rounded-right rounded-left rounded-bottom p-3 mb-3 font-weight-bold">
	Ups, no tenemos productos en este momento
</div>

<?php endif; ?>
<div class="row">
	<div class="col">
		<div class="row">

			<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			
			<div class="col-sm-3">
				<form method="post" action="<?php echo e(url('Page/Store')); ?>">
					<?php echo csrf_field(); ?>
					
					<div class="card text-center mb-3 "style="border-color: pink">
						<div class="card-body">
							<div class="card-img img-fluid img mx-auto mb-2 ">
							
								<img src="<?php echo e(asset('storage/'.str_replace('public/',null,$element->photo))); ?>" width="150" height="230" alt="">	
							</div>
							<h4 class="card-title"><?php echo e($element->nameproduct); ?></h4>
							<p class="card-text">Stock: <?php echo e($element->stock); ?></p>
							<p class="card-text">$./ <?php echo e($element->price); ?></p>
							<select name="stockclient" class="form-control">
								<?php

								for($i= 0; $i < $element->stock ; $i++):
									?>
									<option value="<?php echo e($i+1); ?>"><?php echo e($i+1); ?></option>
									<?php
								endfor;
								?>
							</select>
							<div class="encrypt">
								<input type="hidden" name="nameproduct" value="<?php echo e(Crypt::encryptString($element->nameproduct)); ?>" placeholder="">
								<input type="hidden" name="stock" value="<?php echo e(Crypt::encryptString($element->stock)); ?>" placeholder="">
								<input type="hidden" name="price" value="<?php echo e(Crypt::encryptString($element->price)); ?>" placeholder="">
								<input type="hidden" name="brand" value="<?php echo e(Crypt::encryptString($element->brand)); ?>" placeholder="">
								<input type="hidden" name="id" value="<?php echo e(Crypt::encryptString($element->idproduct)); ?>" placeholder="">
							</div>
							<button type="submit" class="btn btn-primary mt-3">Añadir</button>
						</div>
					</div>
				</form>
			</div>
			
			
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</div>
		
	</div>
	
</div>

<style>
	.img{
		transition: all 1000ms;
	}

	.img:hover{
		transform: scale(2.5);
	}
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.HeaderPage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\TheSkinPower\resources\views/page/products.blade.php ENDPATH**/ ?>