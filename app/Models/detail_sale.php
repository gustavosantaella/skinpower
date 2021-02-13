<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class detail_sale extends Model
{
	use HasFactory;
	protected $fillable  =['idsale','idproduct','nameproduct','brand','price','stock'];
	const table = 'detail_sales';


	public static function add($array)
	{
		for ($i=-0; $i <count($array['idproduct']) ; $i++)
		{ 
			
			$query=	DB::table(self::table)->insert([
				'idproduct'=>$array['idproduct'][$i],
				'idsale'=>$array['idsale'],
				'brand'=>$array['brand'][$i],
				'nameproduct'=>$array['nameproduct'][$i],
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
