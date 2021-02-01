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
}
