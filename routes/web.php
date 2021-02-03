<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

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
Route::get('/',function () {
	return view('welcome');
});
Route::get('Page/Store','Products@index');
Route::post('Page/Store','Cart@addToCart');

/*Users*/
Route::get('User/SignIn',function(){
	return view('Users/SignIn');
});

Route::post('User/SignIn','Users@SignIn');

Route::get('User/Register',function(){
	return view('Users/Register');
});
Route::post('User/Register','Users@Register');
Route::get('Verify/email',"Users@updateVerified");
Route::get('User/LogOut','Users@LogOut');
Route::get('User/Profile','Users@Profile');
Route::post('User/Profile','Users@update');
Route::get('User/resendTokken','Users@resendTokken');

/*Cart*/
Route::get('Cart/Show',function(){
		return view('Cart/Cart');
});
Route::post('Cart/remove','Cart@remove');

/*Orders*/

Route::post('Orders/addOrder','Orders@addOrder');