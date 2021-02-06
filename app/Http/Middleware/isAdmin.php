<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
      if ( !isset($_SESSION['rol']) ||$_SESSION['rol']==='CLIENT')
      {
       return   redirect()->route('HomePage');
     }
     else
     {
       return $next($request);
     }
   }
 }
