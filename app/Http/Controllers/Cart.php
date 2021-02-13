<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Crypt;

class Cart extends Controller
{
	public function __construct()
	{

	}

	public function addToCart(Request $request)
	{

		$this->validate($request,[
			'_token'=>'required',
			'stockclient'=>'required',
			'nameproduct'=>'required',
			'stock'=>'required',
			'price'=>'required'
		]);
		if (Crypt::decryptString($request->nameproduct)&&Crypt::decryptString($request->brand)&&Crypt::decryptString($request->stock)&&Crypt::decryptString($request->price)&&Crypt::decryptString($request->id))
		{
			$datos = 
			[
				'idproduct'=>Crypt::decryptString($request->id),
				'nameproduct'=>Crypt::decryptString($request->nameproduct),
				'brand'=>Crypt::decryptString($request->brand),
				'price'=>Crypt::decryptString($request->price),
				'stock client'=> $request->stockclient
			];
			
			if (!isset($_SESSION['carrito']))
			{
				$_SESSION['carrito'][0] = $datos;

				return redirect()->back()->with('message','New item in the cart')->with('type','success');

			}
			else
			{
				$status = false;
				foreach ($_SESSION['carrito'] as $key => $value)
				{

					if ($value['idproduct']==$datos['idproduct'])
					{
						$status = true;
					}

				}	
				
				if ($status)
				{

					return redirect()->back()->with('message','You cannot add the same item twice')->with('type','danger');
				}

				else
				{
					$posicion = count($_SESSION['carrito']);
					$_SESSION['carrito'][$posicion] = $datos;

					return redirect()->back()->with('message','New item in the cart')->with('type','success');

				}

			}
		}
		else
		{
			return redirect()->back()->with('message',$this->error['message'])->with('type',$this->error['type']);
		}

	}

	public function remove(Request $request)
	{
		$this->validate($request,[
			'_token'=>'required',
			'IdProduct'=>'required',
		]);

		if (is_string(Crypt::decryptString($request->IdProduct))) 
		{
			$id = Crypt::decryptString($request->IdProduct);
			foreach ($_SESSION['carrito'] as $key => $value)
			{
				if ($value['idproduct']==$id)
				{
					unset($_SESSION['carrito'][$key]);
					return redirect()->back()->with('message','remove product succefully')->with('type','success');
				}

			}	
		}
		else
		{
			return redirect()->back()->with('message',$this->error['message'])->with('type',$this->error['type']);
		}
	}


}
