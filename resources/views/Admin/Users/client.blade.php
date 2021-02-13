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
			<th>Creado</th>
	{{-- 		<th>Status</th> --}}
			<th colspan="2">Opciones</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($users->all() as $element)
			<tr>
				<td>{{$element->id}}</td>
				<td>{{$element->name}}</td>
				<td>{{$element->email}}</td>
				<td>{{$element->phone}}</td>
				<td>{{date('d-m-Y H:i:s a',strtotime($element->created_at))}}</td>
		{{-- 		<td>{{$element->status}}</td> --}}
				
				<td>
					<a href="{{ route('eliminar user',[Crypt::encryptString($element->id)]) }}" class="btn btn-danger font-weight-bold">Eliminar</a>
				</td>
			</tr>
		@endforeach
	</tbody>
</table>
{{$users->links()}}
</div>
@endsection