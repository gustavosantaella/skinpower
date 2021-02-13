
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
					@if (!isset($_SESSION['phone']) && $_SESSION['phone'] =='')
					<li class="nav-item dropdown no-arrow mx-1">
						<a class="nav-link dropdown-toggle" href="{{  route('profile',[Crypt::encryptString($_SESSION['iduser'])]) }}" id="alertsDropdown" >
							<i class="fas fa-bell"></i>
							<!-- Counter - Alerts -->
							<span class="badge badge-danger badge-counter">*</span>

						</a>
					</li>
					@endif




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

		<div class="footer-body shadow-lg w-100 shadow-sm text-center ">

			<div class="contact  col-md-12 mt-3 mb-3 pt-4 ml-xl-5 d-flex text-center ">




				<div class="p-xl-3 text-center col-md-10">
					<div class="social text-center">
						<p class="font-weight-bold h5 mb-5">Contáctanos</p>
					<a href="https://www.instagram.com/theskinpower/?hl=es-la" target="_blank"title="instagram">	<i class="fab fa-instagram fa-7x"></i></a>
					<a href="https://linktr.ee/TheSkinPower" title="whatsapp" target="_blank">	<i class="fab fa-whatsapp text-success fa-7x ml-3"></i></a>
					<a href="mailto:theskinpower.ca@gmail.com" title="email"target="_blank">	<i class="fas fa-envelope-open-text fa-7x ml-3"></i></a>
					</div>
				</div>

			</div>




			<div class="copyright text-center my-auto">
				<span>Copyright &copy; The Skin Power  {{ date('Y')}}, All rights reserved.</span>
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

