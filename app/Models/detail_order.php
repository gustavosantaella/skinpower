<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class detail_order extends Model
{
	use HasFactory;
	const table = 'detail_orders';

	public static function create($array)
	{
		for ($i=-0; $i <count($array['idproduct']) ; $i++)
		{ 
			
			$query=	DB::table(self::table)->insert([
				'idproduct'=>$array['idproduct'][$i],
				'idorder'=>$array['idorder'][0],
				'price'=>(double)$array['price'][$i],
				'stock'=>$array['stock'][$i],
			]);
		}

		if (!$query) {
			return false;
		}

		return true;
	}
}
