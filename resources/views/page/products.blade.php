@extends('layouts.HeaderPage')
@section('content')

@if (session('message'))

	<div class="alert-{{session('type')}} rounded-top rounded-right rounded-left rounded-bottom p-3 mb-3 font-weight-bold">
		{{session('message')}}
	</div>
	@elseif($errors->any())

	@foreach($errors->all() as $error)
	<ul>
		

<div class="alert-danger rounded-top rounded-right rounded-left rounded-bottom p-3 mb-3 font-weight-bold">
		<li>{{$error}}</li>
	</div>
	@endforeach
</ul>
@endif
<div class="row">
	<div class="col">
		<div class="row">
			@foreach ($products as $element)
			
			<div class="col-sm-3">
				<form method="post" action="{{ url('Page/Store') }}">
					@csrf
					
					<div class="card text-center mb-3 "style="border-color: pink">
						<div class="card-body">
							<div class="card-img img-fluid img mx-auto mb-2 ">
								<img src="{{ asset('img/DINAMIC/Acido hialuronico.png') }}" width="150" height="230" alt="">	
							</div>
							<h4 class="card-title">{{$element->nameproduct}}</h4>
							<p class="card-text">Stock: {{$element->stock}}</p>
							<p class="card-text">$./ {{$element->price}}</p>
							<select name="stockclient" class="form-control">
								@php

								for($i= 0; $i < $element->stock ; $i++):
									@endphp
									<option value="{{$i+1}}">{{$i+1}}</option>
									@php
								endfor;
								@endphp
							</select>
							<div class="encrypt">
								<input type="hidden" name="nameproduct" value="{{Crypt::encryptString($element->nameproduct)}}" placeholder="">
								<input type="hidden" name="stock" value="{{Crypt::encryptString($element->stock)}}" placeholder="">
								<input type="hidden" name="price" value="{{Crypt::encryptString($element->price)}}" placeholder="">
								<input type="hidden" name="brand" value="{{Crypt::encryptString($element->brand)}}" placeholder="">
								<input type="hidden" name="id" value="{{Crypt::encryptString($element->idproduct)}}" placeholder="">
							</div>
							<button type="submit" class="btn btn-primary mt-3">Add to cart</button>
						</div>
					</div>
				</form>
			</div>
			
			
			@endforeach
		</div>
		
	</div>
	
</div>
@stop