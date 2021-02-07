<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models as order;
use App\Models as detail;
use DB;

class Orders extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function addOrder(Request $request)
	{
		
		$this->validate($request,[
			'product'=>'required|Array',
			'price'=>'required|Array',
			'stock'=>'required|Array',
			'nameProduct'=>'required|Array',
			'brand'=>'required|Array',
			'total'=>'required',
			'name'=>'required',
			'email'=>'required',
			'phone'=>'required',
			'payMethod'=>'required',
			'idUser'=>'required',
			

		]);
		$datos = [];
		$total = 0;
		for ($i=0; $i <count($request->product) ; $i++)
		{ 
			if (
				is_numeric(Crypt::decryptString($request->product[$i]))&&
				is_numeric(Crypt::decryptString($request->price[$i]))&&
				is_numeric(Crypt::decryptString($request->stock[$i]))&&
				is_numeric(Crypt::decryptString($request->idUser))&&
				is_string(Crypt::decryptString($request->payMethod))&&
				is_numeric(Crypt::decryptString($request->price[$i]))&&
				is_numeric(Crypt::decryptString($request->stock[$i]))

			)
			{
				$total += Crypt::decryptString($request->price[$i])*Crypt::decryptString($request->stock[$i]);
				
				$datos['idproduct'][]= Crypt::decryptString($request->product[$i]);
				$datos['stock'][]= Crypt::decryptString($request->stock[$i]);
				$datos['price'][]= number_format(Crypt::decryptString($request->price[$i]),2,',','.');
				

			}
			else
			{
				return redirect()->back()->with('message','Ha ocurrido un error');
			}
		}
		$datos['idUser'][]= Crypt::decryptString($request->idUser);
		$datos['total'][] =number_format($total,2,',','.');
		$datos['payMethod'][]= Crypt::decryptString($request->payMethod);
		if (!order\Orders::exists($datos) || !order\Orders::stockExist($datos))
		{

			return redirect()->back()->with('message','Por favor revise la existencia de los productos o la cantidad disponible.');
		}

		if (!DB::table('users')->where('id',$datos['idUser'])->select('*')->count() )
		{
			return redirect()->route('signin')->with('message','Inicia sesión para poder realizar un pedido.');
		}
		

		if (!order\Orders::create($datos) )
		{
			return redirect()->back()->with('message','Ha ocurrido un error al agregar el pedido.');
		}
		$datos['idorder'][]=$id = DB::getPdo()->lastInsertId();

		$datos['idorder'][0];
		if (!detail\detail_order::create($datos) ||!order\Orders::restarCantidad($datos))
		{
			return redirect()->back()->with('message','Ha ocurrido un error al agregar el pedido.');
		}

		unset($_SESSION['carrito']);
		return redirect()->back()->with('message','Agregado exitosamente.');
		
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function list()
	{
		$list =DB::table('orders')
		->join('users','users.id','=','orders.iduser')
		->select(
			'users.*',
			'orders.id as idorder',
			'orders.pay as pay',
			'orders.status as status',
			'orders.created_at as creacion',
			'orders.total as total')
		->paginate(10);

		if (!$list) 
		{
			abort(500);
		}

		return view('Admin.orders.list',compact('list'));
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		//
	}
}
