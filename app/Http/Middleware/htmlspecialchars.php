<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class htmlspecialchars
{	
	public function handle(Request $request, Closure $next)
	{

		foreach($request->all() as $el)
		{
			if (!htmlspecialchars($el,ENT_QUOTES,'UTF-8'))
			{
				abort(500);
			}
			else
			{
				return $next($request);
			}
		}


	}
}
