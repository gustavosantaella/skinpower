<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use DB;
use Illuminate\Http\Request;
use App\Models as Usuarios;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Str;
use PHPMailer\PHPMailer;
use Illuminate\Support\Facades\Mail;
use App\Mail\Mails;

use DateTime;
use Exception;

class Users extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('America/Caracas');
	}

	public function Register(Request $request)
	{
		$this->validate($request,[
			'name'=>'required|Min:5',
			'lastname'=>'required|Min:5',
			'email'=>'required|Min:5|email',
			'phone'=>'required|Min:13|Max:13',
			'pass'=>'required|Min:6',

		]);
		
		$pass =  Hash::make($request->pass);
		$tokken  = Str::random(100);
		$date = new DateTime();
		$date->modify('+60 minutes');
		$array =
		[
			'name'=>strtoupper($request->name),
			'lastname'=>strtoupper($request->lastname),
			'email'=>strtoupper($request->email),
			'phone'=>strtoupper($request->phone),
			'rol'=>strtoupper('client'),
			'created_at'=>date('d-m-Y H:i:s ',time()),
			'pass'=>$pass,
			'tokken'=>$tokken,
			'verified'=>false,
			'email_verified_at'=>$date->format('d/m/Y H:i:s'),
		];



		if (Usuarios\Users::Exists($array)):
			return redirect()->back()->withInput()->with('message','This user or phone is already exist');
		else:
			if (Usuarios\Users::Register($array)):

				$id = DB::getPdo()->lastInsertId();
				
			$correo = new Mails('Verify your email',$id,$array);


				if (Mail::to($array['email'])->send($correo)===null) 
				{
					return redirect()->back()->with('message','Please, check your email and confirm your email, u have 5 minutes');
				}
				else
				{
					return redirect()->back()->with('message','Error');
				}
			else:
				return redirect()->back()->with('message','Error');
			endif;
		endif;




	}

	public function updateVerified(Request $request)
	{
		$this->validate($request,[
			'id'=>'required|Min:20',
			'state'=>'required|Min:20',
		]);

		
		if (is_numeric(Crypt::decryptString($request->id))&&is_numeric(Crypt::decryptString($request->state))&&is_string(Crypt::decryptString($request->tokken)))
		{
			$datos = [
				'verified'=>Crypt::decryptString($request->state),
				'tokken'=>Crypt::decryptString($request->tokken),
				'email_verified_at'=>date('d-m-Y H:i:s ',time()),
			];
			$id = Crypt::decryptString($request->id);
			$tokken = Crypt::decryptString($request->tokken);

			if (DB::table('users')->select('tokken','email_verified_at')->where('tokken','=',$tokken)->where('email_verified_at','>',now())->find($id)) 
			{
				if (Usuarios\Users::updateVerified($datos,$id)) 
				{
					$removeTokken = DB::update('UPDATE users SET tokken=null WHERE id=:id',[':id'=>$id]);

					return redirect('User/SignIn')->with('message','Email verified, SignIn.');
				}
				else
				{
					return redirect('User/SignIn')->with('message','Error');
				}
			}


			else
			{
	
				DB::delete("DELETE FROM users WHERE id=:id",[':id'=>$id]);
				return redirect('User/SignIn')->with('message','Your tokken expired, your username was deleted, please register again.');
			}
			
		}else
		{

			return redirect('User/SignIn')->with('message','Error');
		}

	}
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function SignIn(Request $request)
	{
		$this->validate($request,[
			'email'=>'required|email',
			'pass'=>'required|Min:6',
		]);

		if (Usuarios\Users::Exist((strtoupper($request->email)))) 
		{
			$var = (Usuarios\Users::Exist((strtoupper($request->email))));
			if ($var->verified ===false) {
				
				return redirect()->back()->withInput()->with('message','Email not verified, check your email and confirm.');
				
			}

			if (strcasecmp($request->email, $var->email) ===0) 
			{
				if (Hash::Check($request->pass,$var->pass)) 
				{
					$_SESSION['name'] = "$var->name $var->lastname";
					$_SESSION['email'] = $var->email;
					$_SESSION['iduser'] = $var->id;
					$_SESSION['phone'] = $var->phone;
					$_SESSION['rol'] = $var->rol;

					if ($var->rol ==='CLIENT')
					{
						return redirect('/');
					}
					else
					{
						return redirect('Admin/Home');
					}
				}
				else
				{
					return redirect()->back()->withInput()->with('message','Invalid password');
				}
			}
			else
			{
				return redirect()->back()->withInput()->with('message','Invalid user');
			}

		}
		else
		{
			return redirect()->back()->withInput()->with('message','Invalid user');
		}

	}


	public function LogOut()
	{
		if (session_destroy())
		{
			return redirect('/');
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function Profile(Request $request)
	{
		$this->validate($request,['id'=>'required']);

		$id = Crypt::decryptString($request->id);
		if(!isset($_SESSION['iduser'])):redirect('/'); endif;
		$user = DB::table('users')->select('*')->find($id);

		return view('Users/update')->with('user',$user);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request)
	{
		$this->validate($request,[
			'iduser'=>'required|Min:20',
			'email'=>'required|Min:10',
			'name'=>'required|Min:5',
			'lastname'=>'required|Min:5',
			'phone'=>'required|Min:13|Max:13',

		]);
		$id =Crypt::decryptString($request->iduser);
		if (usuarios\Users::updateUser($request,$id)) {
			$_SESSION['name']=strtoupper($request->name);
			$_SESSION['lastname']=strtoupper($request->lastname);
			$_SESSION['email']=strtoupper($request->email);
			$_SESSION['phone']=$request->phone;
			return redirect()->back()->with('message','Changed succefully');
		}
		else
		{
			return redirect()->back()->with('message','error');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		//
	}
}
