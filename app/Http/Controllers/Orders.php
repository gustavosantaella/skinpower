<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models as order;
use App\Models as detail;
use DB;
use App\Events as e;

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

		$existe = order\Orders::stockExist($datos);
		for ($i=0; $i <count($existe) ; $i++) { 
			if (!$existe[$i]) {
				return redirect()->back()->with('message','Revise que la cantidad este disponible');

			}
		}

		if (!order\Orders::exists($datos)  )
		{
			
			return redirect()->back()->with('message','Por favor revise la existencia de los productos');
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
		
		$resta =(order\Orders::restarCantidad($datos));
		for ($i=0; $i <count($resta) ; $i++) { 
			if (!$resta[$i]) {
				return redirect()->back()->with('message','Error en la resta, no se pudo agregar el pedido');

			}
		}
		if (!detail\detail_order::create($datos) )
		{
			return redirect()->back()->with('message','Ha ocurrido un error al agregar el pedido.');
		}

		unset($_SESSION['carrito']);
		return redirect()->back()->with('message',"
			Nos comunicaremos con usted via email o por mensaje a su número de teléfono			
			");
		
	}

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

	public function destroy(Request $request)
	{
		
		$this::validate($request,[
			'idproduct'=>'required',
			'idorder'=>'required',
			'stock'=>'required',
			'_token'=>'required'
		]);

		$data =[];
		for ($i=0; $i <count($request->idproduct) ; $i++) { 
			if (is_numeric(Crypt::decryptString($request->idproduct[$i]))&&is_numeric(Crypt::decryptString($request->idorder))&&is_numeric(Crypt::decryptString($request->stock[$i]))) 
			{
				$data['idproduct'][]=Crypt::decryptString($request->idproduct[$i]);
				$data['stock'][]=Crypt::decryptString($request->stock[$i]);
			}
		}
		$data['idorder'][] = Crypt::decryptString($request->idorder);
		
		if (!order\Orders::sumarCantidad($data)) 
		{
			redirect()->back()->with('message','Error al Sumar cantidad');
		}
	/*	if (!detail\detail_order::where('idorder',$data['idorder'])->delete())
		{
			redirect()->back()->with('message','Error al eliminar el pedido');
		}*/
		if (!order\orders::where('id',$data['idorder'])->delete())
		{
			redirect()->back()->with('message','Error al eliminar el pedido');
		}

		return redirect()->route('listar pedidos')->with('message','Pedido eliminado exitosamente');
		
	}

	public function listOrdersUser($id)
	{
		$id = Crypt::decryptString($id);
		$list = order\Orders::where('iduser',$id)
		->join('users','users.id','=','orders.iduser')
		->select('orders.id as idorder','orders.created_at as creacion','orders.total as total','orders.pay as pay','users.*')
		->paginate(5);

		return view('Page.ordersList',compact('list'));
	}
}
