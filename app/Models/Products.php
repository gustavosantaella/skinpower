<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Products extends Model
{
	use HasFactory;

	public static function listProductsPage(){

		return DB::select('SELECT * FROM Products WHERE stock > :stock AND status = :status',[':stock'=>0,':status'=>TRUE]);
	}
}
