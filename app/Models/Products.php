<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Products extends Model
{
	use HasFactory;

	public static function listProductsPage(){

		return DB::select('SELECT * FROM Products WHERE stock > :stock AND status = :status ORDER BY idproduct ASC',[':stock'=>0,':status'=>TRUE]);

	}

	public static function i(array $array)
	{
		return DB::table('products')->insert($array);
	}


	public static function edit($array,$id)
	{
		$id = (integer)$id;
		return DB::table('products')->where('idproduct',$id)->update($array);
	}
}
