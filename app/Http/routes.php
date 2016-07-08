<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::auth();
Route::get('/register/success', 'Auth\AuthController@success');
Route::get('/register/error', 'Auth\AuthController@error');
Route::get('/confirm', 'Auth\AuthController@confirm');
Route::get("/error", "ErrorController@index");

Route::group(['middleware' => ['auth', 'enable']], function() {
	Route::group(['middleware' => ['ajax']], function() {
		Route::get('/', 'HomeController@index');
		Route::get('/home', 'HomeController@home');
		Route::get('/dashboard', 'DashboardController@index');

		Route::post('user/enable/{user}/{enable?}', 'UserController@enable');
		Route::resource('user', 'UserController');
	});
});
