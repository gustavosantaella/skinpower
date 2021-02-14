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
		<!-- Sidebar -->

		<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" style="background: pink!important" id="accordionSidebar">

			<!-- Sidebar - Brand -->
			<a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('AdminHome') }}">
				<div class="sidebar-brand-icon rotate-n-15">
					<i class="fas fa-laugh-wink"></i>
				</div>
				<div class="sidebar-brand-text mx-3">The Skin Power </div>
			</a>

			<!-- Divider -->
			<hr class="sidebar-divider my-0">

			<!-- Nav Item - Dashboard -->
			<li class="nav-item active">
				<a class="nav-link" href="{{ route('AdminHome') }}">
					<i class="fas fa-fw fa-tachometer-alt"></i>
					<span>Dashboard</span></a>
				</li>

				<!-- Divider -->
				<hr class="sidebar-divider">

				<!-- Heading -->
				<div class="sidebar-heading font-weight-bold text-dark">
					Opciones
				</div>

				<!-- Nav Item - Pages Collapse Menu -->
				<li class="nav-item">
					<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
					aria-expanded="true" aria-controls="collapsePages">
					<i class="fas fa-fw fa-folder"></i>
					<span class="text-dark font-weight-bold">Gestionar</span>
				</a>
				<div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
					<div class="bg-white py-2 collapse-inner rounded">
						<h6 class="collapse-header">Productos:</h6>
						<a class="collapse-item" href="{{ route('add product') }}">Agregar Productos</a>
						<a class="collapse-item" href="{{ route('listar productos') }}">Listar Productos</a>

						<div class="collapse-divider"></div>
						<h6 class="collapse-header">Otras opciones:</h6>

						<a class="collapse-item" href="forgot-password.html">Olvide mi contraseña</a>
					</div>
				</div>
			</li>

			<!-- Nav Item - Charts -->

			<!-- Nav Item - Tables -->
			<li class="nav-item">
				<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#tablas"
				aria-expanded="true" aria-controls="collapsePages">
				<i class="fas fa-fw fa-folder"></i>
				<span class="text-dark font-weight-bold">Tablas</span>
			</a>
			<div id="tablas" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
				<div class="bg-white py-2 collapse-inner rounded">
					<h6 class="collapse-header">Pedidos:</h6>
					<a class="collapse-item" href="{{ route('listar pedidos') }}">Pedidos pendientes</a>
					<a class="collapse-item" href="{{ route('listar ventas') }}">Ventas</a>
					<div class="collapse-divider"></div>
					<h6 class="collapse-header">Otras tablas:</h6>
					<a class="collapse-item" href="{{ route('listar admin') }}">Administradores</a>
					<a class="collapse-item" href="{{ route('listar clientes') }}">Clientes</a>
					{{-- 	<a class="collapse-item" href="{{ route('administradores') }}">Administradores</a> --}}
				</div>
			</div>
		</li>

		<!-- Divider -->
		<hr class="sidebar-divider d-none d-md-block">

		<!-- Sidebar Toggler (Sidebar) -->
		<div class="text-center d-none d-md-inline">
			<button class="rounded-circle border-0" id="sidebarToggle"></button>
		</div>

		<!-- Sidebar Message -->


	</ul>
	<!-- End of Sidebar -->




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
					{{-- 	<h3>The Skin Power</h3> --}}

				</div>
			</form>

			<!-- Topbar Navbar -->
			<ul class="navbar-nav ml-auto">

				<!-- Nav Item - Search Dropdown (Visible Only XS) -->

				<div id="icon-user"></div>
				<!-- Nav Item - Alerts -->


				<!-- Nav items -->

				

				


				<!-- end nav items  -->
				<div class="topbar-divider d-none d-sm-block"></div>

				<!-- Nav Item - User Information -->
				<li class="nav-item dropdown no-arrow">
					<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
					data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<span class="mr-2 d-none d-lg-inline text-gray-600 small">
						<?php if (isset($_SESSION['name'])):?>
						<?php echo $_SESSION['name'] ?>

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

				<a class="dropdown-item "  href="{{   route('profile',[Crypt::encryptString($_SESSION['iduser'])])}}" style="cursor: pointer;">
					<i class="far fa-id-badge fa-sm fa-fw mr-2"></i>
					Mi perfil
				</a>

				<a class="dropdown-item "  href="{{ route('HomePage') }}" style="cursor: pointer;">
					<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
					Ver página
				</a>
				<a class="dropdown-item "  href="{{ url('User/LogOut') }}" style="cursor: pointer;">
					<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
					Cerrar sesión
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

