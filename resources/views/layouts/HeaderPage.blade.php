
<!DOCTYPE html>
<html lang="en" style="overflow-x:hidden;">

<head>


	<script type="text/javascript" >
		var navInfo = window.navigator.appVersion.toLowerCase();
//var so = null;

function retornarSO()
{
	if(navInfo.indexOf('win') != -1)
	{


	}
	else if(navInfo.indexOf('linux') != -1)
	{
    //so = 'Linux';

}
else if(navInfo.indexOf('mac') != -1)
{
   // so = 'Macintosh';
}

}


</script>

<!-- Bootstrap core JavaScript-->


<meta charset="utf-8">
<meta http-equiv="Cache-Control" content="no-store" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">

<title>The Skin Power</title>

<!-- Custom fonts for this template-->
<link href="{{ asset('css/fontawesome/css/all.min.css') }}" rel="stylesheet" type="text/css">
<link
href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
rel="stylesheet">
<script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
<link rel="icon"  href="{{ asset('img/TheSkinPower1.jpg') }}">
<!-- Custom styles for this template-->
<link rel="stylesheet" type="text/css" href="{{asset('css/sb-admin-2.min.css')}}">
@yield('css')
</head>

<body id="page-top">
	<!-- Page Wrapper -->
	{{-- START SIDEBAR ADMIN --}}
	<div id="wrapper">


		{{-- FIN SIDEBAR ADMIN --}}

		<div id="content-wrapper" class="d-flex flex-column">

			<!-- Main Content -->
			<div id="content">

				<!-- Topbar -->
				<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow w-100" >

					<!-- Sidebar Toggle (Topbar) -->


					<!-- Topbar Search -->
					<form
					class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
					<div class="input-group">
						<h3>The Skin Power</h3>

					</div>
				</form>

				<!-- Topbar Navbar -->
				<ul class="navbar-nav ml-auto">

					<!-- Nav Item - Search Dropdown (Visible Only XS) -->

					<div id="icon-user"></div>
					<!-- Nav Item - Alerts -->


					<!-- Nav items -->

					<li class="nav-item dropdown no-arrow mx-1">
						<a class="nav-link dropdown-toggle" href="{{ url('Page/Store') }}" id="alertsDropdown" >
							<i class="fas fa-store-alt"></i>

						</a>
					</li>
					<li class="nav-item dropdown no-arrow mx-1">
						<a class="nav-link dropdown-toggle" href="{{ url('Cart/Show') }}" id="alertsDropdown" >
							<i class="fas fa-shopping-cart"></i>
							<!-- Counter - Alerts -->
							<span class="badge badge-danger badge-counter"><?php echo (isset($_SESSION['carrito']))? count($_SESSION['carrito']):0; ?></span>
						</a>
					</li>




					<li class="nav-item dropdown no-arrow mx-1">
						<a class="nav-link dropdown-toggle" href="{{ url('/') }}" id="alertsDropdown" >
							<i class="fas fa-home"></i>
							<!-- Counter - Alerts -->

						</a>
					</li>



					<!-- end nav items  -->
					<div class="topbar-divider d-none d-sm-block"></div>

					<!-- Nav Item - User Information -->
					<li class="nav-item dropdown no-arrow">
						<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
						data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<span class="mr-2 d-none d-lg-inline text-gray-600 small">
							<?php if (isset($_SESSION['name']) &&isset($_SESSION['lastname'])):?>
							<?php echo "$_SESSION[name] $_SESSION[lastname] "?>

							<?php else: ?>
							Guest
							<?php endif ?>

						</span>
						<img class="img-profile rounded-circle"
						src="{{ asset('img/undraw_profile.svg') }}">
					</a>
					<!-- Dropdown - User Information -->
					<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
					aria-labelledby="userDropdown">

					<div class="dropdown-divider"></div>
					<!-- href="user/Login" -->

					<?php if (isset($_SESSION['name'])): ?>

					<a class="dropdown-item "  href="{{ url('User/Profile') }}?id={{Crypt::encryptString($_SESSION['iduser'])}}" style="cursor: pointer;">
						<i class="far fa-id-badge fa-sm fa-fw mr-2"></i>
						Mi perfil
					</a>

					@if ($_SESSION['rol']==='ADMIN')
					<a class="dropdown-item " href="{{ url('Admin/Home') }}" style="cursor: pointer;">
						<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
						Gestionar
					</a>
					@endif
					<a class="dropdown-item "  href="{{ url('User/LogOut') }}" style="cursor: pointer;">
						<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
						Cerrar sesión
					</a>

					<?php else: ?>
					<a class="dropdown-item " href="{{ url('User/SignIn') }}" style="cursor: pointer;">
						<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
						Iniciar sesión
					</a>
					<?php endif ?>


				</div>
			</li>

		</ul>

	</nav>

	{{-- content --}}
	<div class="container-fluid">
		@yield('content')
	</div>


	{{-- start foooter --}}

	<footer class="mt-5 bg-white">
		<div class=" w-100">
			<div class="footer-body shadow-lg w-100 shadow-sm ">

				<div class="contact  col mt-3 mb-3 pt-4 ml-5 d-flex">
					<div class="col-md-5">
						<div class="card bg-light">
							<div class="card-header h3">Envianos un Email</div>
							<div class="card-body ">


								<form class="">
									<fieldset class="form-group">
										<label for="name">Primer nombre</label>
										<input type="text" required="" class="form-control" name="name" id="name" placeholder="Your name...">

									</fieldset>
									<fieldset class="form-group">
										<label for="lastName">Primer apellido</label>
										<input type="text" required="" class="form-control" name="lastname" id="lastName" placeholder="Your last namet...">
									</fieldset>

									<fieldset class="form-group">
										<label for="Email">Email</label>
										<input type="email" required="" class="form-control" name="email" id="Email" placeholder="Your email...">
									</fieldset>

									<fieldset class="form-group">
										<label for="affair">Asunto</label>
										<input type="text" required="" class="form-control" name="email" id="affair" placeholder="Affair">
									</fieldset>

									<fieldset class="form-group">
										<label for="message">Mensaje</label>
										<textarea name="message" required="" class="form-control" placeholder="Message..."></textarea>
									</fieldset>
									<fieldset class="form-group">

										<button class="btn btn-primary font-weight-bold" type="submit">Enviar</button>
									</fieldset>
								</form>
							</div>
						</div>
					</div>


					<div class="col-md-5">
						<div class="p-xl-5">
							<div class="social text-center">
								<p class="font-weight-bold h5 mb-5">Contáctanos</p>
								<i class="fab fa-instagram fa-7x"></i>
								<i class="fab fa-whatsapp text-success fa-7x ml-3"></i>
								<i class="fas fa-envelope-open-text fa-7x ml-3"></i>
							</div>
						</div>


						<div class="img-fluid">
							<img src="{{ asset('img/TheSkinPower1.jpg') }}" alt="The skin power" width="200" height="200" class="rounded-pill offset-md-5" >
						</div>
					</div>




				</div>




				<div class="copyright text-center my-auto">
					<span>Copyright &copy; The Skin Power  {{ date('Y')}}, All rights reserved.</span>
				</div>
			</div>


		</div>
	</footer>

	<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
	<i class="fas fa-angle-up"></i>
</a>

<style>
	html::-webkit-scrollbar {

		display: none;  /* Ocultar scroll */
	}

</style>

<script src="{{ asset('js/jquery/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('css/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/jquery/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
<script src="{{ asset('js/functions.js') }}"></script>
@yield('script')


</body>
</html>



<!-- End of Topbar -->

<!-- Begin Page Content -->

