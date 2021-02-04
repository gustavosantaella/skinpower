<?php $__env->startSection('content'); ?>
<div class="bg-danger" class="img"
style="background-image: url('<?php echo e(asset('img/banner.jpg')); ?>');    
height: 200px; /* You must set a specified height */
background-position: center; /* Center the image */
position: relative;
top: -23px;
right: 7%;
width: 110%;
background-repeat: no-repeat; /* Do not repeat the image */
background-size: cover; /* Resize the background image to cover the entire container */"
>
<div class="text-center p-2 h1">

	<div >
		<p class="font-weight-bold"><p class="h6">The Skin Power</p>Your best choice</p>
		<p class="typed h5 text-center"></p>

	</div>


</div>
</div>
<div class="container-fluid">

	


	<!-- Marketing messaging and featurettes-->

	<!-- Wrap the rest of the page in another container to center all the content. -->

	<div class="container marketing">

		<!-- Three columns of text below the carousel -->
		<div class="row">
			<div class="col-lg-4">
				<img class="img-fluid img"style="transition: all 1000ms" src="<?php echo e(asset('img/DINAMIC//Acido hialuronico.png')); ?>" alt="Generic placeholder image" width="140" height="250">
				<h2>Heading</h2>
				<p class="text-justify">Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p>

			</div><!-- /.col-lg-4 -->

				<div class="col-lg-4">
				<img class="img-fluid img"style="transition: all 1000ms" src="<?php echo e(asset('img/DINAMIC//Acido hialuronico.png')); ?>" alt="Generic placeholder image" width="140" height="250">
				<h2>Heading</h2>
				<p class="text-justify">Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p>

			</div><!-- /.col-lg-4 -->

				<div class="col-lg-4">
				<img class="img-fluid img"style="transition: all 1000ms" src="<?php echo e(asset('img/DINAMIC//Acido hialuronico.png')); ?>" alt="Generic placeholder image" width="140" height="250">
				<h2>Heading</h2>
				<p class="text-justify">Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p>

			</div><!-- /.col-lg-4 -->

				<div class="col-lg-4">
				<img class="img-fluid img"style="transition: all 1000ms" src="<?php echo e(asset('img/DINAMIC//Acido hialuronico.png')); ?>" alt="Generic placeholder image" width="140" height="250">
				<h2>Heading</h2>
				<p class="text-justify">Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p>

			</div><!-- /.col-lg-4 -->

		</div><!-- /.row -->


	</div>

</div>
<?php $__env->stopSection(); ?>


<style>
	.img:hover{
		transform: scale(2.4);

	}
</style>

<?php $__env->startSection('script'); ?>
<script src="<?php echo e(asset('js/typed.js')); ?>"></script>
<script src="<?php echo e(asset('js/mainTyped.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/HeaderPage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\TheSkinPower\resources\views/welcome.blade.php ENDPATH**/ ?>