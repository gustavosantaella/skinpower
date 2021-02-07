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
			<h4 class="card-title">Pedido #:{{$id}}</h4>
			<h6 class="card-subtitle mb-2 text-muted">{{"$user->name $user->lastname"}}</h6>

			<div class="card-body">
				<table class="table table-striped table-hover border-primary"  >

					<thead>
						<tr>
							<th width="25">Product</th>
							<th width="25">Brand</th>
							<th width="25">Stock</th>
							<th width="25">Price</th>
							<th width="25">Total</th>
						</tr>
					</thead>
					<tbody>

						@foreach ($detail as $key => $value)
						<form  action="{{ url('Cart/remove') }}" method="post">
							@csrf

							<tr>
								<td width="25"> {{$value['nameproduct'] }}</td>
								<td width="25">{{$value['brand']}}</td>
								<td hidden="">
									{{ $product['product'][]=Crypt::encryptString($value['idproduct'])}}
									{{ $product['nameProduct'][]=Crypt::encryptString($value['nameproduct'] )}}
									{{ $product['price'][]=Crypt::encryptString($value['price'])}}
									{{ $product['stock'][]=Crypt::encryptString($value['stock'])}}
									{{ $product['brand'][]=Crypt::encryptString($value['brand'])}}
								</td>
								<td width="25">{{$value['stock']}}</td>
								<td width="25">$./{{number_format($value['price'],2,',','.')}}</td>
								<td width="25">$./{{number_format($value['price']*$value['stock'],2,',','.')}}</td>


								<td hidden=""><input type="hidden" readonly  required="" name="IdProduct" value="{{Crypt::encryptString($value['idproduct'])}}" placeholder=""></td>

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
	
	<form method="post" action="{{ url('Orders/addOrder') }}">
		@csrf

		<h1>Realizado por:</h1>

		@for($i=0; $i<count($product['product']); $i++)
		<div class="d-flex" hidden="">
			<input type="hidden" name="product[]" value="{{  $product['product'][$i]}}">
			<input type="hidden" name="price[]" value="{{  $product['price'][$i]}}">
			<input type="hidden" name="stock[]" value="{{  $product['stock'][$i]}}">
			<input type="hidden" name="nameProduct[]" value="{{  $product['nameProduct'][$i]}}">
			<input type="hidden" name="brand[]" value="{{  $product['brand'][$i]}}">
			<input type="hidden" name="idUser" value="{{ Crypt::encryptString($_SESSION['iduser']) }}">

		</div>

		@endfor
		<input type="hidden" name="total" value="{{Crypt::encryptString(number_format($total,2,',','.'))}}" placeholder="">
		<fieldset class="form-group">

			<label for="name">Nombre </label>
			<input type="text" class="form-control" id="name" required=""  readonly="" value="{{"$user->name $user->lastname"}}">

			{{-- 	<input type="hidden" class="form-control" id="name" required="" name="name" readonly="" value="{{ "$user->name $user->lastname"}}"> --}}
		</fieldset>

		<fieldset class="form-group">
			<label for="email">Email</label>
			{{-- <input type="hidden" class="form-control" id="email" required="" name="email" readonly="" value="{{ $user->email}}"> --}}

			<input type="text" class="form-control" id="email" required=""  readonly="" value="{{ $user->email}}">
		</fieldset>

		<fieldset class="form-group">
			<label for="phone">Teléfono</label>
{{-- 			<input type="hidden" class="form-control" id="phone" name="phone" required="" readonly="" value="{{   $user->phone}}">
 --}}
			<input type="tel" class="form-control" id="phone"  required="" readonly="" value="{{  $user->phone}}">
		</fieldset>

		<fieldset class="form-group">
			<h3>Método de pago</h3> 
			
			<input type="text" disabled="" class="form-control" name="pay" value="{{ $user->pay}}" placeholder="">
		</fieldset>
		<button type="submit" class="btn btn-primary font-weight-bold">Aceptar</button>
		<a  class="btn btn-danger font-weight-bold">Declinar</a>
	</form>



	
</div>
@stop