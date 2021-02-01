@extends('layouts.HeaderPage')
@section('content')
@php
$total = 0;
$prdocut= [];
@endphp

<div class="container-fluid">
	@if (session('message'))
	<div class="alert-{{session('type')}} rounded-top rounded-right rounded-left rounded-bottom font-weight-bold p-3 mb-3">
		{{session('message')}}
	</div>

	@elseif (!isset($_SESSION['name']))
	<div class="alert-warning rounded-top rounded-right rounded-left rounded-bottom font-weight-bold p-3 mb-3">
		Please Login <a href="{{ url('User/SignIn') }}" title="SignIn">here</a> to Order
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
	@if (isset($_SESSION['carrito']))

	@if (count($_SESSION['carrito'])>0)
	<div class="card ">
		<div class="card-body">
			<h4 class="card-title">Your cart</h4>
			<h6 class="card-subtitle mb-2 text-muted">{{(isset($_SESSION['name']))?$_SESSION['name'] :null}}</h6>

			<div class="card-body">
				<table class="table table-striped table-hover border-primary"  >

					<thead>
						<tr>
							<th width="25">Product</th>
							<th width="25">Brand</th>
							<th width="25">Stock</th>
							<th width="25">Price</th>
							<th width="25">Total</th>
							<th width="25">Opction</th>
						</tr>
					</thead>
					<tbody>

						@foreach ($_SESSION['carrito'] as $key => $value)
						<form  action="{{ url('Cart/remove') }}" method="post">
							@csrf

							<tr>
								<td width="25"> {{$value['nameproduct'] }}</td>
								<td width="25">{{$value['brand']}}</td>
								<td hidden="">{{ $product['product'][]=Crypt::encryptString($value['idproduct'])}}
									{{ $product['nameProduct'][]=Crypt::encryptString($value['nameproduct'] )}}
									{{ $product['price'][]=Crypt::encryptString($value['price'])}}
									{{ $product['stock'][]=Crypt::encryptString($value['stock client'])}}
								{{ $product['brand'][]=Crypt::encryptString($value['brand'])}}</td>
								<td width="25">{{$value['stock client']}}</td>
								<td width="25">$./{{number_format($value['price'],2,',','.')}}</td>
								<td width="25">$./{{number_format($value['price']*$value['stock client'],2,',','.')}}</td>


								<td hidden=""><input type="hidden" readonly  required="" name="IdProduct" value="{{Crypt::encryptString($value['idproduct'])}}" placeholder=""></td>
								<td width="25"><button type="submit" name="" class="btn btn-danger font-weight-bold">Delete</button></td>

								<td hidden="">{{ $total+=($value['price']*$value['stock client'])}}</td>
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
	@if (isset($_SESSION['name']))
	<form method="post" action="{{ url('Orders/addOrder') }}">
		@csrf

		<h1>The order will be sent to:</h1>
		<small class="alert-info p-1 rounded-left rounded-right rounded-top rounded-bottom font-weight-bold">
		If the data is incorrect, please go to "My profile" and change the data.</small>


		@for($i=0; $i<count($product['product']); $i++)
		<div class="d-flex" hidden="">
			<input type="hidden" name="product[]" value="{{  $product['product'][$i]}}">
			<input type="hidden" name="price[]" value="{{  $product['price'][$i]}}">
			<input type="hidden" name="stock[]" value="{{  $product['stock'][$i]}}">
			<input type="hidden" name="nameProduct[]" value="{{  $product['nameProduct'][$i]}}">
			<input type="hidden" name="brand[]" value="{{  $product['brand'][$i]}}">

		</div>

		@endfor
		<input type="hidden" name="total" value="{{Crypt::encryptString(number_format($total,2,',','.'))}}" placeholder="">
		<fieldset class="form-group">

			<label for="name">Name user</label>
			<input type="text" class="form-control" id="name" required="" name="name" readonly="" value="{{  $_SESSION['name']}}">
		</fieldset>

		<fieldset class="form-group">
			<label for="email">Email</label>
			<input type="text" class="form-control" id="email" required="" name="email" readonly="" value="{{  $_SESSION['email']}}">
		</fieldset>

		<fieldset class="form-group">
			<label for="phone">Phone number</label>
			<input type="tel" class="form-control" id="phone" name="phone" required="" readonly="" value="{{  $_SESSION['phone']}}">
		</fieldset>

		<fieldset class="form-group">
			<h3>Pay method</h3> 
			<input type="radio" name="payMethod" required="" value="ZELLE" placeholder=""> ZELLE<br>
			<input type="radio" name="payMethod" required="" value="USD" placeholder=""> USD<br>
			<input type="radio" name="payMethod" required="" value="BS" placeholder=""> BS<br>
			<input type="radio" name="payMethod" required="" value="OTHER" placeholder=""> OTHER<br>
		</fieldset>
		<button type="submit" class="btn btn-primary font-weight-bold">Accept</button>
	</form>
	@endif 

	@else
	<div class="alert-warning rounded-top rounded-right rounded-left rounded-bottom font-weight-bold p-3">
		Empty cart!
	</div>
	@endif
	@else
	<div class="alert-warning rounded-top rounded-right rounded-left rounded-bottom font-weight-bold p-3">
		Empty cart!
	</div>

	@endif 
</div>
@stop