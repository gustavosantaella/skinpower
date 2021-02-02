<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class Users extends Model  
{
	use HasFactory;
	protected $table ='users';
	public static function Register(array $datos):bool
	{
		try 
		{

			return DB::table('users')->insert($datos);

		} 
		catch (Exception $e) 
		{

			return $e->getMessage();

		}
	}
	public static function updateVerified(array $datos,$id)
	{
		return DB::update('UPDATE  users SET verified=:verified WHERE id=:id',[
			
			'verified'=>true,
			':id'=>$id
		]);

	}

	public static function updateUser(object $datos,$id)
	{
		return DB::update('UPDATE users SET name=:name, lastname=:lastname, email=:email, phone=:phone WHERE id=:id',[
			'name'=>strtoupper($datos->name),
			'lastname'=>strtoupper($datos->lastname),
			'email'=>strtoupper($datos->email),
			'phone'=>$datos->phone,
			'id'=>$id,
		]);
	}

	public static function Exists(array $datos):int
	{
		return DB::table('users')->select('*')->where('email','=',$datos['email'])->count();
	}

	public static function Exist(string $datos)
	{
		return DB::table('users')->select('*')->where('email','=',$datos)->first();
	}

}
