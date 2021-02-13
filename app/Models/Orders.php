<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class Orders extends Model
{
	use HasFactory;

	public static function create($array)
	{
		$array['total'][0] = (double)$array['total'][0];

		return DB::insert(
			"INSERT INTO orders (iduser,pay,total,status,created_at) VALUES(:iduser,:pay,:total,:status,:created_at)",
			[
				':iduser'=>$array['idUser'][0],
				':pay'=>$array['payMethod'][0],
				':total'=>$array['total'][0],
				':status'=>FALSE,
				':created_at'=>now(),
			]
		);
	}

	public static function exists($array)
	{

		for($i= 0; $i<count($array['idproduct']); $i++)
		{

			$query=	DB::table('products')
			->where('idproduct',$array['idproduct'][$i])
			->select('*')
			->count();
		}

		if (!$query) {
			return false;
		}
		return true;
		
	}

	public static function stockExist($array)
	{
		$data = [];
		
		for($i= 0; $i<count($array['idproduct']); $i++)
		{

			$data[]= DB::table('products')
			->where('idproduct',$array['idproduct'][$i])
			->where('stock','>=',$array['stock'][$i])
			->select('*')->count();
		}
		return $data;
	}

	public static function restarCantidad($array)
	{
		$data = [];
		for($i= 0; $i<count($array['idproduct']); $i++)
		{

			$data[]= DB::update("UPDATE products SET stock=stock-:cantidad WHERE idproduct=:idproduct",
				[
					':cantidad'=>$array['stock'][$i],
					':idproduct'=>$array['idproduct'][$i]
				]
			);
		}
		return $data;

	}

	public static function sumarCantidad($array)
	{
		if (is_object($array)) {
			foreach ($array as $e) {
				$query=	DB::update("UPDATE products SET stock=stock+:cantidad WHERE idproduct=:idproduct",
					[
						':cantidad'=>$e->stock,
						':idproduct'=>$e->idproduct
					]
				);
			}
		}
		else
		{
			for($i= 0; $i<count($array['idproduct']); $i++)
			{

				$query=	DB::update("UPDATE products SET stock=stock+:cantidad WHERE idproduct=:idproduct",
					[
						':cantidad'=>$array['stock'][$i],
						':idproduct'=>$array['idproduct'][$i]
					]
				);
			}
		}
		if (!$query) {
			return false;
		}

		return true;
	}

	
}
