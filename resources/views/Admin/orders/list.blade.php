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
			<th>Nombre</th>
			<th>Correo</th>
			<th>Tlfn</th>
			<th>Realizado</th>
			<th>Método</th>
			<th>Total</th>
			<th colspan="2">Opciones</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($list->all() as $element)
			<tr>
				<td>{{$element->idorder}}</td>
				<td>{{$element->name}}</td>
				<td>{{$element->email}}</td>
				<td>{{$element->email}}</td>
				<td>{{date('d-m-Y H:i:s a',strtotime($element->creacion))}}</td>
				<td>{{$element->pay}}</td>
				<td>$./{{$element->total}}</td>
				<td>
					<a href="{{ route('ver pedido',[Crypt::encryptString($element->idorder),Crypt::encryptString($element->id)]) }}" class="btn btn-primary font-weight-bold">Consultar</a>
				</td>
			</tr>
		@endforeach
	</tbody>
</table>
{{$list->links()}}
@endsection