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

			return	DB::table('products')
			->where('idproduct',$array['idproduct'][$i])
			->select('*')
			->count();
		}
		
	}

	public static function stockExist($array)
	{
		for($i= 0; $i<count($array['idproduct']); $i++)
		{

			return	DB::table('products')
			->where('idproduct',$array['idproduct'][$i])
			->where('stock','>',$array['stock'][$i])
			->select('*')->count();
		}
	}

	public static function restarCantidad($array)
	{
		for($i= 0; $i<count($array['idproduct']); $i++)
		{

			return	DB::update("UPDATE products SET stock=stock-:cantidad WHERE idproduct=:idproduct",
				[
					':cantidad'=>$array['stock'][$i],
					':idproduct'=>$array['idproduct'][$i]
				]
			);
		}
	}


	
}
