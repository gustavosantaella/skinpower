<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Middleware;
use App\Models as productos;
use Stevebauman\Purify\Facades\Purify;
use DB;
use Crypt;
use Storage;
class Products extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$res = productos\Products::listProductsPage();

		return view('page.products')->with('products',$res);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create(Request $request)
	{

		$this::validate($request,
			[
				'_token'=>'required|Min:20|string',
				'marca'=>'required|string',
				'nombre'=>'required|string',
				'status'=>'required|boolean',
				'descripcion'=>'required|string',
				'cantidad'=>'required|numeric',
				'precio'=>'required|numeric',
				'foto'=>'required|Max:70000|image',


			]);


		$array = [
			'brand'=>$request->marca,
			'nameproduct'=>$request->nombre,
			'price'=>$request->precio,
			'stock'=>$request->cantidad,
			'status'=>$request->status,
			'photo'=>$request->file('foto')->store('public/img'),
			'created_at'=>now(),

		];

		if (DB::table('products')->where('nameproduct',$request->nombre)->count()) {
			return redirect()->back()->withInput()->with('message','El nombre del producto ya existe');
		}
		if (!productos\Products::i($array)) {
			return redirect()->route('add product');
		}

		return redirect()->route('add product')->with('message','Agregado exitosamente');
	}

	public function list()
	{

		$products  = productos\Products::paginate(10);
		return view('Admin.products.list',compact('products'));
	}

	public function destroy( $idproduct)
	{
		if (!is_numeric(Crypt::decryptString($idproduct))) {
			abort(500);
		}
		$idpro = Crypt::decryptString($idproduct);
		$delete = productos\Products::where('idproduct',$idpro);
		$deleteOrder = productos\detail_order::where('idproduct',$idpro)->count();
		if ($deleteOrder > 0) {
			return redirect()->back()->with('message','No se puede eliminar, verifique que no haya pedidos asociado a este producto, si desea eliminar este producto, elimine los pedidos asociados a este.');
		}
		$img = productos\Products::where('idproduct',$idpro)->first();
		Storage::delete($img->photo); 
		if (!$delete->delete()) {
			return redirect()->back()->with('message','Error al eliminar');

		}
		return redirect()->back()->with('message','Eliminado exitosamente');
	}


	public function edit($id)
	{
		if (!is_numeric(Crypt::decryptString($id))) {
			abort(500);
		}

		$idpro = Crypt::decryptString($id);
		$producto = productos\Products::where('idproduct',$idpro)->first();

		return view('Admin.products.edit',compact('producto'));
	}

	public function update(Request $request)
	{
		$this::validate($request,
			[
				'_token'=>'required|Min:20|string',
				'marca'=>'required|string',
				'nameproduct'=>'required|string|unique:products,nameproduct,'.Crypt::decryptString($request->idproduct).',idproduct',
				'status'=>'required|boolean',
				'cantidad'=>'required|numeric',
				'precio'=>'required|numeric',
				'idproduct'=>'required',


			]);


		$array = [
			'brand'=>$request->marca,
			'nameproduct'=>$request->nameproduct,
			'price'=>$request->precio,
			'stock'=>$request->cantidad,
			'status'=>$request->status,
			

		];

		/*if (DB::table('products')->where('nameproduct',$request->nombre)->count()) {
			return redirect()->back()->withInput()->with('message','El nombre del producto ya existe');
		}*/
		if (!productos\Products::edit($array,Crypt::decryptString($request->idproduct))) {
		abort(500);
		
		}

		return redirect()->route('listar productos')->with('message','Actualizado correctamente');
	}
}
