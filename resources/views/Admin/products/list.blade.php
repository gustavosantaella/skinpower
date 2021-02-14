@extends('layouts.HeaderAdmin')

@section('content')
@if (session('message'))
	<div class="alert alert-info rounded-top rounded-right rounded-left rounded-bottom p-3">
		{{session('message')}}
	</div>
@endif
<table class="table table-responsive table-inverse  table-hover text-center">
	<thead>
		<tr>
			<th>Id</th>
			<th>Foto</th>
			<th>Marca</th>
			<th>Nombre</th>
			<th>Precio</th>
			<th>Cantidad</th>
			<th>Status</th>
			<th>Creado</th>
		
			<th colspan="2">Opciones</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($products as $element)
			<tr>
				<td>{{$element->idproduct}}</td>
				<td><img src="{{ asset("img/DINAMIC/$element->photo") }}" width="100" height="100" alt="">	</td>
				<td>{{$element->brand}}</td>
				<td>{{$element->nameproduct}}</td>
				<td>{{$element->price}}</td>
				<td>{{$element->stock}}</td>
			@if (!$element->status)
				<td><i class="fas fa-times-circle text-danger"> </i></td>
				@else
					<td><i class="fas fa-check text-success"> </i></td>
			@endif
				<td>{{date('d-m-Y H:i:s a',strtotime($element->created_at))}}</td>
		
				<td>
					<a href="{{ route('eliminar producto',[Crypt::encryptString($element->idproduct)])}}" class="btn btn-danger font-weight-bold">Eliminar</a>
				</td>
				<td>
					<a href="{{ route('modificar producto',[Crypt::encryptString($element->idproduct)])}}" class="btn btn-warning font-weight-bold">Modificar</a>
				</td>
			</tr>
		@endforeach
	</tbody>
</table>

{{$products->links()}}

</div>
@endsection
