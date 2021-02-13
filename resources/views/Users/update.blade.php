@extends('layouts.HeaderPage')
@section('content')

<h1>Cambiar datos del usuario</h1>
@if ($errors->any())
<div class="alert alert-danger rounded-left rounded-right rounded-bottom rounded-top p-3 font-weight-bold">
	<ul>
		@foreach ($errors->all() as $element)

		<li>{{$element}}	</li>


		@endforeach
	</ul>
</div>
@elseif(session('message'))
<div class="alert alert-info rounded-right rounded-top rounded-bottom rounded-left p-3 font-weight-bold">
	{{session('message')}}
</div>
@endif
<div class="card">

	<div class="card-body">
		<form class="" method="POST" action="{{ url('User/Profile') }}">
			@csrf

			<fieldset class="form-group">
				<label for="name">Primer nombre</label>
				<input type="text" class="form-control" id="name" required="" minlength="5" name="name" value="{{$user->name}}" placeholder="Name...">
			</fieldset>
			<fieldset class="form-group">
				<label for="lastname">Apellido</label>
				<input type="text" class="form-control" id="lastname" required="" minlength="5" name="lastname" value="{{$user->lastname}}" placeholder="Lastname...">
			</fieldset>

			<fieldset class="form-group">
				<label for="phone">N&uacute;mero de tel&eacute;fono</label>
				<input type="tel" class="form-control @if (!isset($_SESSION['phone']) && $_SESSION['phone'] =='')
				border-danger
				@endif" id="phone"   minlength="13" min="13" max="13" maxlength="13" name="phone"value="{{$user->phone}}" placeholder="Phone...">
			</fieldset>
			<fieldset class="form-group">
				<input type="hidden" name="iduser" required="" value="{{Crypt::encryptString($user->id)}}" placeholder="">
				<input type="submit" class="btn btn-primary font-weight-bold" value="Aceptar">
			</fieldset>
		</form>
	</div>
	
</div>

<div class="card mt-4">

	<div class="card-body">
		<div class="card-title h3 ">
			Cambiar correo electr&oacute;nico
		</div>
		<form action="{{ route('updateEmail') }}" method="POST" accept-charset="utf-8">
			@csrf

			<fieldset class="form-group">
				<label for="email">Tu email</label>
				<input type="email" class="form-control" id="email"required=""  minlength="10" name="email" value="{{$user->email}}"placeholder="Email...">
			</fieldset>


			<fieldset class="form-group">
				<input type="hidden" name="iduser" required="" value="{{Crypt::encryptString($user->id)}}" placeholder="">
				<input type="submit" class="btn btn-primary font-weight-bold" value="Aceptar">
			</fieldset>
		</form>
	</div>
	
</div>
@stop