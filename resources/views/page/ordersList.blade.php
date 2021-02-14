@extends('layouts.HeaderPage')

@section('content')

@if (session('message'))
<div class="alert alert-info rounded-top rounded-right rounded-left rounded-bottom p-3">
	{{session('message')}}
</div>
@endif
<div class="row">
	

	<div class="col-8">
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
					{{-- 	<th colspan="2">Opciones</th> --}}
				</tr>
			</thead>
			<tbody>
				@foreach ($list->all() as $element)
				<tr>
					<td>{{$element->idorder}}</td>
					<td>{{$element->name}}</td>
					<td>{{$element->email}}</td>
					<td>{{$element->phone}}</td>
					<td>{{date('d-m-Y H:i:s a',strtotime($element->creacion))}}</td>
					<td>{{$element->pay}}</td>
					<td>$./{{$element->total}}</td>
				{{-- <td>
					<a href="{{ route('ver pedido user',[Crypt::encryptString($element->idorder),Crypt::encryptString($element->id)]) }}" class="btn btn-primary font-weight-bold">Consultar</a>
				</td> --}}
			</tr>
			@endforeach
		</tbody>
	</table>
	{{$list->links()}}


</div>


<div class="col-4">
	<div class="card">
		<div class="card-body text-justify">
			<div class="card-title h2">
				<p>Com&oacute; se cu&aacute;ndo se acept&oacute; mi pedido?</p>
			</div>	
			Una vez revisado el pedido, nos pondremos en cont&aacute;cto con usted. Luego de concretar el pago, el pedido se eliminara de su bandeja de <b>pedidos</b> automaticamente.	
		</div>
	</div>
</div>

</div>







</div>
@endsection