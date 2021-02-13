<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class Sale extends Model
{
	use HasFactory;
	protected $fillable  =['iduser','nameuser','emailuser','phoneuser','pay','total','created_at'];
	
}
