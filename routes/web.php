<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Middleware as m;
use Illuminate\Support\Facades\View;

session_start();
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Page*/
Route::view('/',"welcome")->name('HomePage');

Route::get('Page/Store','Products@index')->name('Ver productos');
Route::post('Page/Store','Cart@addToCart')->name('Agg produsctos al carrito');

/*Users*/


Route::group(['prefix'=>'User'],function(){

	Route::view('SignIn','Users.SignIn');
	Route::post('SignIn','Users@SignIn');
	Route::view('Register','Users/Register')->name('register');
	Route::post('Register','Users@Register');
	Route::get ('Verify/email',"Users@updateVerified");
	Route::get ('LogOut','Users@LogOut');
	Route::get ('Profile','Users@Profile');
	Route::post('Profile','Users@update');
	Route::get ('resendTokken','Users@resendTokken');
	Route::view('ForgotPassword','Users.forgotPassword')->name('forgot password');
	Route::post('ForgotPassword','Users@resetPassword');
	Route::get ('resetPass','Users@resetPass');
	Route::post('resetPass','Users@resetclave');
});


/*Cart*/
Route::view('Cart/Show','Cart/Cart')->name('show cart');
Route::post('Cart/remove','Cart@remove');

/*Orders*/

Route::post('Orders/addOrder','Orders@addOrder');

/*Admin*/

Route::group(['prefix'=>'Admin','middleware'=>'isAdmin'], 
	function()
	{

		Route::view('Home','Admin.Home')
		->name('AdminHome');

		Route::View('Products/add','Admin/products/add')->name('add product');

		Route::post('Products/add','Products@create')
		->name('add');

		Route::get('Admin/Pedidos/list','Orders@list')
		->name('listar pedidos');
	});