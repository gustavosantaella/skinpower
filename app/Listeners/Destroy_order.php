<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models as order;

class Destroy_order
{
	/**
	 * Create the event listener.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}

	/**
	 * Handle the event.
	 *
	 * @param  object  $event
	 * @return void
	 */
	public function handle($event)
	{
		if (!order\orders::where('id',$event->id)->delete()) {
			redirect()->back()->with('message','Error al eliminar el pedido');
		}

		 redirect()->route('listar pedidos')->with('message','Eliminado exitosamente');
	}
}
