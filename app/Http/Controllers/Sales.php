<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Crypt;
use App\Models as sale;
use DB;
class Sales extends Controller
{
	public function add(Request $request)
	{

		$this::validate($request,[
			'_token'=>'required',
			'product'=>'required|array',
			'price'=>'required|array',
			'stock'=>'required|array',
			'nameProduct'=>'required|array',
			'brand'=>'required|array',
			'idUser'=>'required',
			'total'=>'required',
			'name'=>'required',
			'email'=>'required',
			'phone'=>'required',
			'pay'=>'required',
		]);
		

		$datos = [];
		$total = 0;
		for ($i=0; $i <count($request->product) ; $i++)
		{ 
			if (
				is_numeric(Crypt::decryptString($request->product[$i]))&&
				is_string(Crypt::decryptString($request->nameProduct[$i]))&&
				is_string(Crypt::decryptString($request->brand[$i]))&&
				is_numeric(Crypt::decryptString($request->price[$i]))&&
				is_string(Crypt::decryptString($request->total))&&
				is_numeric(Crypt::decryptString($request->stock[$i]))&&
				is_string(Crypt::decryptString($request->phone))&&
				is_string(Crypt::decryptString($request->name))&&
				is_string(Crypt::decryptString($request->email))&&
				is_string(Crypt::decryptString($request->idUser))&&
				is_string(Crypt::decryptString($request->idorder))&&
				is_string(Crypt::decryptString($request->pay))

			)
			{

				$datos['idproduct'][]=Crypt::decryptString($request->product[$i]);
				$datos['nameproduct'][]=Crypt::decryptString($request->nameProduct[$i]);
				$datos['brand'][]=Crypt::decryptString($request->brand[$i]);
				$datos['price'][]=Crypt::decryptString($request->price[$i]);
				$datos['stock'][]=Crypt::decryptString($request->stock[$i]);
				

			}


		}

		$datos['iduser']=Crypt::decryptString($request->idUser);
		$datos['idorder']=Crypt::decryptString($request->idorder);
		$datos['nameuser']=Crypt::decryptString($request->name);
		$datos['emailuser']=Crypt::decryptString($request->email);
		$datos['phoneuser']=Crypt::decryptString($request->phone);
		$datos['pay']=Crypt::decryptString($request->pay);
		$datos['total']=(double)Crypt::decryptString($request->total);
		

		if (!sale\Sale::create($datos)) {
			return redirect()->route('listar pedidos')->with('message','Error, no se puedo agregar la venta');
		}


		$datos['idsale'] = DB::getPdo()->lastInsertId();

		$detail = new sale\detail_sale;
		if (!$detail->add($datos)) {
			return redirect()->route('listar pedidos')->with('message','Error, se agrego la venta mas no el detalle');
		}
		$removeOrder = sale\Orders::find($datos['idorder']);

		if(!$removeOrder->delete())
		{
			return redirect()->route('listar pedidos')->with('message','Error, se agrego la venta mas no se elimino el pedido');
		}

		return redirect()->route('listar pedidos')->with('message','Vendido');

	}

	public function list()
	{
		$list =sale\Sale::paginate(10);

		if (!$list) 
		{
			abort(500);
		}

		return view('Admin.sales.list',compact('list'));
	}


	public function destroy(Request $request)
	{
		$request->idsale = Crypt::decryptString($request->idsale);
		$removeSale = sale\Sale::find($request->idsale);
		if (!$removeSale->delete()) {
			return redirect()->route('listar ventas')->with('message','Error');
		}
		return redirect()->route('listar ventas')->with('message','Eliminado');
	}

}