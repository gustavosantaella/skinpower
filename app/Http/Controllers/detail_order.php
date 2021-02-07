<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models as detail;
use App\Models as order;

class detail_order extends Controller
{
	public function view($id,$iduser)
	{

		if (!is_numeric(Crypt::decryptString($id))&&!is_numeric(Crypt::decryptString($iduser))) 
		{
			abort(500);
		}
		$id = Crypt::decryptString($id);
		$detail = detail\detail_order::join('products','products.idproduct','=','detail_orders.idproduct')->where('idorder',$id)->get();
		$user = order\Orders::join('users','users.id','orders.iduser',)->find(($id));

		if (!$detail && !$user)
		{
			abort(500);
		}
		return view('Admin.orders.view',compact('detail','user','id'));
	}
}
