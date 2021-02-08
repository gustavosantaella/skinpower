<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
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

Route::group(['prefix'=>'Page'],function()
{
	Route::get('Store','Products@index')->name('Ver productos');
	Route::post('Store','Cart@addToCart')->name('Agg produsctos al carrito');
});

/*Users*/
Route::group(['prefix'=>'User'],function(){

	Route::view('SignIn','Users.SignIn')->name('signin');
	Route::post('SignIn','Users@SignIn')->middleware('specialchars');
	Route::view('Register','Users/Register')->name('register');
	Route::post('Register','Users@Register')->middleware('specialchars');
	Route::get ('Verify/email',"Users@updateVerified");
	Route::get ('LogOut','Users@LogOut')->name('logout');
	Route::get ('Profile','Users@Profile')->name('profile');
	Route::post('Profile','Users@update')->middleware('specialchars');
	Route::get ('resendTokken','Users@resendTokken');
	Route::view('ForgotPassword','Users.forgotPassword')->name('forgot password');
	Route::post('ForgotPassword','Users@resetPassword')->middleware('specialchars');
	Route::get ('resetPass','Users@resetPass')->name('resetPass');
	Route::post('resetPass','Users@resetclave')->middleware('specialchars');
});


/*Cart*/
Route::group(['prefix'=>'Cart'],function()
{
	Route::view('Show','Cart/Cart')->name('show cart');
	Route::post('remove','Cart@remove')->middleware('specialchars');
});

/*Orders*/
Route::group(['prefix'=>'Orders'],function()
{
	Route::post('addOrder','Orders@addOrder')->name('addOrder')->middleware('specialchars');
});


/*Admin*/

Route::group(['prefix'=>'Admin','middleware'=>'isAdmin'], 
	function()
	{
		Route::view('Home','Admin.Home')->name('AdminHome');
		Route::View('Products/add','Admin/products/add')->name('add product');
		Route::post('Products/add','Products@create')->name('add')->middleware('specialchars');
		Route::get('Products/list','Products@create')->name('listar productos');
		Route::get('Pedidos/list','Orders@list')->name('listar pedidos');
		Route::get('Pedidos/ver/{id}/{iduser}','detail_order@view')->name('ver pedido');
		Route::post('Pedidos/eliminar','Orders@destroy')->name('eliminar')->middleware('specialchars');

		Route::post('Ventas/add','Sales@add')->name('add ventas')->middleware('specialchars');


	});