

<?php $__env->startSection('content'); ?>

<pre>
	<?php
	$sales = DB::select('SELECT SUM(total) as total, created_at::date as fecha from sales GROUP BY fecha');
/*	$detail = DB::select('SELECT SUM(total) as total, created_at::timestamp as fecha from sales GROUP BY fecha');
	print_r(Count($detail));*/
	?>
</pre>
<div class="row">

	<!-- Earnings (Monthly) Card Example -->
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-primary shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
						Usuarios registrados</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800">
							<?php echo e((DB::table('users')->where('rol','CLIENT')->count()>100)?"+100" : DB::table('users')->where('rol','CLIENT')->count()); ?>

						</div>
					</div>
					<div class="col-auto">
						<i class="fas fa-users fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Earnings (Monthly) Card Example -->
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-dark shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
						Administradores registrados</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800">
							<?php echo e((DB::table('users')->where('rol','ADMIN')->count()>100)?"+10" : DB::table('users')->where('rol','ADMIN')->count()); ?>

						</div>
					</div>
					<div class="col-auto">
						<i class="fas fa-user fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Earnings (Monthly) Card Example -->
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-success shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-success text-uppercase mb-1">
							Ventas
						</div>
						<div class="row no-gutters align-items-center">
							<div class="col-auto">
								<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo e((DB::table('sales')->count()>100)?"+100" : DB::table('sales')->count()); ?></div>
							</div>
							
						</div>
					</div>
					<div class="col-auto">
						<i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Pending Requests Card Example -->
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-warning shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
						Pedidos pendientes</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800">
							<?php echo e((DB::table('orders')->where('status',FALSE)->count()>100)?"+100": DB::table('orders')->where('status',FALSE)->count()); ?>

						</div>
					</div>
					<div class="col-auto">
						<i class="fas fa-time fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

</div>

<div class="grafica mt-5">
	<div class="row">
		<div class="ml-3 col col-md-10">
			<div class="card  ">
				<canvas id="sales" width="600" height="200"></canvas>
			</div>
		</div>



	</div>
	

	
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
<script>
	ctx = document.getElementById('sales').getContext('2d');
	var myChart = new Chart(ctx, {
		type: 'line',
		data: {
			labels: [

			<?php $__currentLoopData = $sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			'<?php echo e(date('d-m-Y ',strtotime($e->fecha))); ?>',
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

			],
			datasets: [{
				label: 'Gancias',
				data: [

				<?php $__currentLoopData = $sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php echo e($e->total); ?>,
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				],
				backgroundColor: [
				'rgba(255, 99, 132, 0.2)',
				'rgba(54, 162, 235, 0.2)',
				'rgba(255, 206, 86, 0.2)',
				'rgba(75, 192, 192, 0.2)',
				'rgba(153, 102, 255, 0.2)',
				'rgba(255, 159, 64, 0.2)'
				],
				borderColor: [
				'rgba(255, 99, 132, 1)',
				'rgba(54, 162, 235, 1)',
				'rgba(255, 206, 86, 1)',
				'rgba(75, 192, 192, 1)',
				'rgba(153, 102, 255, 1)',
				'rgba(255, 159, 64, 1)'
				],
				borderWidth: 1
			}]
		},
		options: {
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero: true
					}
				}]
			}
		}
	});


	/*detalle venta*/

/*
	ctx = document.getElementById('detalle').getContext('2d');
	var myChart = new Chart(ctx, {
		type: 'line',
		data: {
			labels: [

			<?php $__currentLoopData = $sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			'<?php echo e(date('d-m-Y',strtotime($e->fecha))); ?>',
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

			],
			datasets: [{
				label: 'Ventas',
				data: [

				<?php $__currentLoopData = $sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php echo e($e->total); ?>,
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				],
				backgroundColor: [
				'rgba(255, 99, 132, 0.2)',
				'rgba(54, 162, 235, 0.2)',
				'rgba(255, 206, 86, 0.2)',
				'rgba(75, 192, 192, 0.2)',
				'rgba(153, 102, 255, 0.2)',
				'rgba(255, 159, 64, 0.2)'
				],
				borderColor: [
				'rgba(255, 99, 132, 1)',
				'rgba(54, 162, 235, 1)',
				'rgba(255, 206, 86, 1)',
				'rgba(75, 192, 192, 1)',
				'rgba(153, 102, 255, 1)',
				'rgba(255, 159, 64, 1)'
				],
				borderWidth: 1
			}]
		},
		options: {
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero: true
					}
				}]
			}
		}
	});

*/

</script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.HeaderAdmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\TheSkinPower\resources\views/Admin/Home.blade.php ENDPATH**/ ?>