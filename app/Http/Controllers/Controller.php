<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{

	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	public $error =	['message','Por favor contáctanos lo antes posible para solucionar el error.','type','danger'];
	public function __construct(){
		
	}

	public function htmlspecialchars($array)
	{
		
		foreach($array as $el)
		{
			if (!htmlspecialchars($el,ENT_QUOTES,'UTF-8'))
			 {
				return false;
			}
			else
			{
				return true;
			}
		}
	}
}
