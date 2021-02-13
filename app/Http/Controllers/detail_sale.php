<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models as detail;
use Crypt;
class detail_sale extends Controller
{
	public function view($id,$name)
	{
		if (!is_numeric(Crypt::decryptString($id))&&!is_numeric(Crypt::decryptString($name))) 
		{
			abort(500);
		}
		$id = Crypt::decryptString($id);
		$name = Crypt::decryptString($name);
		$detail = detail\detail_sale::join('sales','sales.id','=','detail_sales.idsale')->where('idsale',$id)->select('*')->get();
	

		if (!$detail)
		{
			abort(500);
		}
		return view('Admin.sales.view',compact('detail','id','name'));
	}
}
