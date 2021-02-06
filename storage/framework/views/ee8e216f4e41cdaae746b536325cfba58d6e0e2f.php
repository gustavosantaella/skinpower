

<?php $__env->startSection('content'); ?>
<div class="row">


	<div class="row ml-5">
		<div class="card border-left-primary shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
						Usuarios registrados</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800">
							<?php echo e((DB::table('users')->count()>100)?"+100"::table('users')->count():DB::table('users')->count()); ?>

						</div>
					</div>
					<div class="col-auto">
						<i class="fas fa-users fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>


		<div class="card border-left-dark shadow h-100 py-2 ml-5">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
						Administradores registrados</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800">

							<?php echo e((DB::table('users')->where('rol','ADMIN')->count()>10)?"+10" : DB::table('users')->where('rol','ADMIN')->count()); ?>

						</div>
					</div>
					<div class="col-auto">
						<i class="fas fa-user-lock fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>

		<div class="card border-left-success shadow h-100 py-2 ml-5">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
						Ventas</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800">+10</div>
					</div>
					<div class="col-auto">
						<i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>


		<div class="card border-left-info shadow h-100 py-2 ml-5">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
						Pedidos pendientes</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800">	
							<?php echo e((DB::table('orders')->where('status',FALSE)->count()>100)?"+100": DB::table('orders')->where('status',FALSE)->count()); ?>

						</div>
					</div>
					<div class="col-auto">
						<i class="fas fa-calendar fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>




	</div>

</div>

<div class="grafica mt-5">

	<h1>tratar de usar chart.js para generar grafica de las ventas</h1>
	
</div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.HeaderAdmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\TheSkinPower\resources\views/Admin/Home.blade.php ENDPATH**/ ?>