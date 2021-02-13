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
use Arr;
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
			'pass'=>'required|Min:6',

		]);
		
		$pass =  Hash::make($request->pass);
		$tokken  = Str::random(100);
		$date = new DateTime();
		$date->modify('+1 hour');
		$array =
		[
			'name'=>strtoupper($request->name),
			'lastname'=>strtoupper($request->lastname),
			'email'=>strtoupper($request->email),
			'rol'=>strtoupper('client'),
			'created_at'=>date('d-m-Y H:i:s ',time()),
			'pass'=>$pass,
			'tokken'=>$tokken,
			'verified'=>false,
			'email_verified_at'=>$date->format('Y-m-d H:i:s'),
		];
		$array = (object) $array;
		if (Usuarios\Users::Exists($array->email)):
			return redirect()->back()->withInput()->with('message','El correo ya existe');
		else:
			if (Usuarios\Users::Register($array)):

				$id = DB::getPdo()->lastInsertId();
				
				$correo = new Mails('Verify your email',$id,$array,'confirmMail');


				if (Mail::to($array->email)->send($correo)===null) 
				{
					return redirect()->back()->with('message','Please, check your email and confirm your email, u have 1 hour');
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
			'tokken'=>'required|Min:20',
		]);

		
		if (is_numeric(Crypt::decryptString($request->id))&&is_numeric(Crypt::decryptString($request->state))&&is_string(Crypt::decryptString($request->tokken)))
		{
			$datos = [
				'verified'=>Crypt::decryptString($request->state),
				'tokken'=>Crypt::decryptString($request->tokken),
				
			];
			$id = Crypt::decryptString($request->id);
			$tokken = Crypt::decryptString($request->tokken);

			if (DB::table('users')->select('tokken','email_verified_at')->where('tokken','=',$tokken)->where('email_verified_at','>',now())->find($id)) 
			{
				if (Usuarios\Users::updateVerified($datos,$id)) 
				{
					$removeTokken = DB::update('UPDATE users SET tokken=null, email_verified_at=null WHERE id=:id',[':id'=>$id]);

					return redirect('User/SignIn')->with('message','Email verified, SignIn.');

				}
				else
				{
					return redirect('User/SignIn')->with('message','Error');
				}
			}


			else
			{
				
				DB::update('UPDATE users SET tokken=null, email_verified_at=null WHERE id=:id',[':id'=>$id]);
				return redirect('User/SignIn')->with('resend',Crypt::encryptString($id));
			}
			
		}
		else
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
			'_token'=>'required|Min:6',
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
					$_SESSION['name'] = "$var->name";
					$_SESSION['lastname'] = "$var->lastname";
					$_SESSION['email'] = $var->email;
					$_SESSION['iduser'] = $var->id;
					$_SESSION['phone'] = $var->phone;
					$_SESSION['rol'] = $var->rol;

					if ($var->rol ==='CLIENT')
					{
						return redirect('/');
					}
					elseif($var->rol==='ADMIN')
					{
						return redirect('Admin/Home');
					}
					else
					{
						return "error";
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

	public function resendTokken(Request $request)
	{
		$this->validate($request,['id'=>'required|Min:20']);
		$id = Crypt::decryptString($request->id);
		$user = DB::table('users')->select('*')->find($id);
		$date = new DateTime();
		$date->modify('+1 hour');
		$array = ['email_verified_at'=>$date->format('Y-m-d H:i:s'),'tokken'=>Str::random(100)];
		DB::table('users')->where(['id'=>$id])->update($array);
		$correo = new Mails('Verify your email',$id,(object)$array,'confirmMail');
		if (Mail::to($user->email)->send($correo)===null) 
		{
			return redirect('User/SignIn')->with('message','Please, check your email and confirm your email, u have 1 hour');
		}
		else
		{
			return redirect()->back()->with('message','Error');
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
	public function Profile($id)
	{
	
	
		$id = Crypt::decryptString($id);
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
			'name'=>'required|Min:5',
			'lastname'=>'required|Min:5',
			'_token'=>'required|Min:5',
			

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

	public function updateEmail(Request $request)
	{

		$all = $request->all();
		$newArr = Arr::set($all,'email',strtoupper($request->email));
		$newRequest = (new Request($newArr) );
		$this::validate($newRequest,[
			'email'=>'required|Min:5|email|unique:users,email',
			'_token'=>'required|Min:5',
			'iduser'=>'required|Min:5',
		]);



		$id = Crypt::decryptString($request->iduser);
		$correo = new Mails('Verify your email',$id,$newRequest,'confirmMail');
		if (Mail::to($newRequest->email)->send($correo)===null) 
		{
		
			$user =usuarios\Users::find($id);

			$user->verified = false;
			$user->email  = $newRequest->email;
			$user->tokken = Str::random(100);
			$_SESSION['email']=$request->email;
			$user->save();
			unset($_SESSION);
/*				return redirect()->route('signin')->with('message','Por favor confirma tu correo');
*/				return redirect()->back()->with('message','Por favor confirma tu correo');
		}
		else
		{
			return redirect()->back()->with('message','Error');
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
		if (Crypt::decryptString($id)) {
			$id =	Crypt::decryptString($id);
			$order = DB::table('orders')
			->join('users','users.id','=','orders.iduser')
			->join('detail_orders','detail_orders.idorder','=','orders.id')
			->select('detail_orders.stock as stock','detail_orders.idproduct','orders.id')
			->where('iduser',$id)->get();
			
			if (!usuarios\Orders::where('iduser',$id)->count()) {
				$user = usuarios\Users::find($id);
				$user->delete();
				return redirect()->back()->with('message','Eliminado exitosamente');
			};
			
			if (!usuarios\Orders::sumarCantidad($order)) {
				return redirect()->back()->with('message','Ups, error');
			}

			
			$query = DB::table('users')
			->join('orders','orders.iduser','=','users.id')
			->where('users.id',$id)
			->delete();

			return redirect()->back()->with('message','Eliminado exitosamente');
		}
	}

	public function resetPassword(Request $request)
	{
		$this::validate($request,['email'=>'required|email']);
		$request->email = strtoupper($request->email);
		$data =DB::table('users')->where('email','=',$request->email)->select('*')->first();
		if(!$data):
			return redirect()->back()->withInput()->with('message','Invalid email');
		endif;
		
		$data->tokken = Str::random(100);
		$correo = new Mails('Reset your password',null,$data,'resetPass');
		
		if (!Mail::to($request->email)->send($correo)===null) 
		{
			return redirect()->back()->with('message','Ups, error');
		}
		$date = new DateTime();
		$date->modify('+1 hour');
		DB::table('users')->where('id',$data->id)->update(['email_verified_at'=>$date->format('Y-m-d H:i:s'),'tokken'=>$data->tokken]);
		return redirect()->back()->with('message','Please check your email');

	}

	public function resetPass(Request $request)
	{
		$this::validate($request,['id'=>'required|Min:50','tokken'=>'required|Min:50']);
		$id = Crypt::decryptString($request->id);
		$tokken = Crypt::decryptString($request->tokken);

		if (!is_numeric(Crypt::decryptString($request->id))&&!is_string(Crypt::decryptString($request->tokken)))
		{
			return redirect('User/ForgotPassword')->with('message','Ups, error');
		}
		if (!DB::table('users')->where('tokken',$tokken)->where('email_verified_at','>',now())->select('*')->find($id))
		{
			return redirect('User/ForgotPassword')->with('message','Invalid tokken');
		}
		return view('Users/resetPasswordForm')->with('id',$id);
	}

	public function resetclave(Request $request)
	{
		$this::validate($request,
			[
				'pass'=>'required|Min:6|string',
				'_token'=>'required|string',
				'repeat'=>'required|Min:6|same:pass|string',
				'id'=>'required|Min:6|string',
			]);

		$update = [

			'email_verified_at'=>null,
			'tokken'=>null,
			'pass'=>Hash::make($request->pass),


		];
		if (!DB::table('users')->where('id',Crypt::decryptString($request->id))->update($update))
		{
			return redirect()->back()->with('message','Ups, error');
		}

		return redirect('User/SignIn')->with('message','Password changed succefully');
	}

	public function adminsList()
	{

		$users =(usuarios\Users::where('rol','=','ADMIN')->orWhere('rol','=','SU')->paginate(20));
		return view('Admin.Users.admin', compact('users'));	
	}

	public function usersList()
	{

		$users =(usuarios\Users::where('rol','=','CLIENT')->paginate(20));
		return view('Admin.Users.client', compact('users'));	
	}
}

