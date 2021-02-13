@extends('layouts.HeaderAdmin')

@section('content')
<div class="container-fluid">
	@if ($errors->any())
	<div class="alert-danger rounded-top rounded-right rounded-left rounded-bottom p-3 font-weight-bold">
		<ul>
			@foreach ($errors->all() as $element)
			{{$element}}
			@endforeach
		</ul>
	</div>
	@elseif(session('message'))
	<div class="alert-info rounded-top rounded-right rounded-left rounded-bottom p-3 font-weight-bold">
		{{session('message')}}
	</div>
	@endif
	<form method="POST" action="{{ route('editproduct') }}" enctype="multipart/form-data">
		@csrf

		<fieldset class="form-group">
			<label for="exampleInputEmail1">Marca del producto</label>
			<input required="" type="text" pattern="^[a-zA-Z\s]{2,254}" class="val form-control val" id="exampleInputEmail1" required="" name="marca" value="{{$producto->brand}}" placeholder="Marca del producto...">
			<small class="text-muted">Por favor ingrese texto válido.</small>
		</fieldset>

		<fieldset class="form-group">
			<label for="exampleInputPassword1">Nombre del producto</label>
			<input required="" type="text" pattern="^[a-zA-Z\s]{2,254}" class="val form-control" id="exampleInputPassword1" required=" " name="nameproduct" value="{{$producto->nameproduct}}" placeholder="Nombre del producto...">
			<small class="text-muted">Por favor ingrese texto válido.</small>
		</fieldset>

		<fieldset class="form-group">
			<label for="exampleSelect1">¿Activo o Inactivo?</label>
			<select  required=""  class="val form-control" name="status" id="exampleSelect1">
				<option value="{{($producto->status !=true)?0 : 1}}">{{($producto->status !=true)?'Inactivo' : 'Activo'}}</option>
				<option value={{TRUE}}>Activo</option>
				<option value={{0}}>Inactivo</option>

			</select>
			<small class="text-muted">Por favor escoja si desea que el producto se visualice en la página.</small>
		</fieldset>

	{{-- 	<fieldset class="form-group">
			<label for="exampleTextarea">Descripción del producto</label>
			<textarea  required="" class="val form-control" name="descripcion" id="exampleTextarea" rows="3" placeholder="Descripción..."></textarea>
			<small class="text-muted">Por favor ingrese una descripcion breve del producto.</small>
		</fieldset> --}}

		<fieldset class="form-group">
			<label for="exampleInputPassword1">Cantidad</label>
			<input required="" value="{{$producto->stock}}" min="1" pattern="." type="number" class="val form-control" id="exampleInputPassword1" required=" " name="cantidad" placeholder="Cantidad...">
			<small class="text-muted">Por favor ingrese la cantidad de productos que posee, este debe ser un numero entero.</small>
		</fieldset>

		<fieldset class="form-group">
			<label for="exampleInputPassword1">Precio del producto</label>
			<input required="" min="1" value="{{$producto->price}}" step="0.01" type="number" class="val form-control" id="exampleInputPassword1" required=" " name="precio" placeholder="Precio...">
		</fieldset>
		<input type="hidden" name="idproduct" value="{{Crypt::encryptString($producto->idproduct)}}" placeholder="">
		<button type="submit" class="btn btn-primary">Enviar</button>
	</form>
</div>
@endsection