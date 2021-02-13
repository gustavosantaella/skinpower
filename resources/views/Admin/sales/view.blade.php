@extends('layouts.HeaderAdmin')
@section('content')
@php
$total = 0;
$prdocut= [];

@endphp

<div class="container-fluid">
	@if (session('message'))
	<div class="alert-info rounded-top rounded-right rounded-left rounded-bottom font-weight-bold p-3 mb-3">
		{{session('message')}}
	</div>
	@elseif($errors->any())
	<ul>
		@foreach($errors->all() as $error)
		<div class="alert-danger rounded-top rounded-right rounded-left rounded-bottom p-3 mb-3 font-weight-bold">
			<li>{{$error}}</li>
		</div>	
		@endforeach
	</ul>
	@endif 

	<div class="card ">
		<div class="card-body">
			<h4 class="card-title">Venta #{{$id}}</h4>
			<h6 class="card-subtitle mb-2 text-muted">{{"$name"}}</h6>

			<div class="card-body">
				<table class="table table-striped table-hover border-primary"  >

					<thead>
						<tr>
							<th width="20">Producto</th>
							<th width="20">Marca</th>
							<th width="20">Cantidad</th>
							<th width="20">Precio</th>
							<th width="20">Total</th>
						</tr>
					</thead>
					<tbody>

						@foreach ($detail as $key => $value)
						<form  action="{{ url('Cart/remove') }}" method="post">
							@csrf

							<tr>
								<td width="20"> {{$value['nameproduct'] }}</td>
								<td width="05">{{$value['brand']}}</td>
								<td hidden="">
									{{ $product['product'][]=Crypt::encryptString($value['idproduct'])}}
									{{ $product['nameProduct'][]=Crypt::encryptString($value['nameproduct'] )}}
									{{ $product['price'][]=Crypt::encryptString($value['price'])}}
									{{ $product['stock'][]=Crypt::encryptString($value['stock'])}}
									{{ $product['brand'][]=Crypt::encryptString($value['brand'])}}
								</td>
								<td width="20">{{$value['stock']}}</td>
								<td width="20">$./{{number_format($value['price'],2,',','.')}}</td>
								<td width="20">$./{{number_format($value['price']*$value['stock'],2,',','.')}}</td>


								{{-- <td hidden=""><input type="hidden" readonly  required="" name="IdProduct" value="{{Crypt::encryptString($value['idproduct'])}}" placeholder=""></td> --}}

								<td hidden="">{{ $total+=($value['price']*$value['stock'])}}</td>
							</tr>
						</form>
						@endforeach 
						<tr>
							<td colspan="4" class="text-right h3">Total</td>
							<td class="h3">$./{{number_format($total,2,',','.')}}</td>
						</tr>
					</tbody>
				</table>

			</div>
		</div>
	</div>
	
	<div class="">
		{{-- <form method="post" action="">
			@csrf
			<br>
			@for($i=0; $i<count($product['product']); $i++)
			<div class="d-flex" hidden="">
				<input type="hidden" name="product[]" value="{{  $product['product'][$i]}}">
				<input type="hidden" name="price[]" value="{{  $product['price'][$i]}}">
				<input type="hidden" name="stock[]" value="{{  $product['stock'][$i]}}">
				<input type="hidden" name="nameProduct[]" value="{{  $product['nameProduct'][$i]}}">
				<input type="hidden" name="brand[]" value="{{  $product['brand'][$i]}}">
				

			</div>

			@endfor
			
			<button type="submit" class="btn btn-primary font-weight-bold">Devolver venta</button>
		</form> --}}
		<br>
		<form action="{{ route('eliminar venta') }}" method="post" >
			@csrf

			@for($i=0; $i<count($product['product']); $i++)
			<div class="d-flex" hidden="">
				<input type="hidden" name="idproduct[]" value="{{  $product['product'][$i]}}">
				<input type="hidden" name="stock[]" value="{{  $product['stock'][$i]}}">
				<input type="hidden" name="idsale" value="{{  Crypt::encryptString($id)}}">




			</div>

			@endfor
			<button type="submit"  class="btn btn-danger font-weight-bold">Declinar</button>
		</form>


	</div>



</div>
@stop