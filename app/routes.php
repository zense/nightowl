<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::model('user', 'User');

Route::get('/', function()
{	$id = '/u/';
	$id .= Session::getId();
	return Redirect::to($id);
});

Route::get('/u/{id}', 'PageController@buildPage');

Route::post('/ux', function(){
	$obj = new PageController();
	return $obj->store();
	//return 's';
});

Route::get('/profile', function(){
	$user = User::find(Session::getId());
	return Redirect::to('/'.$user->name);
});

Route::post('/profile', function(){
	$user = User::find(Session::getId());
	return Redirect::to('/'.$user->name);
});


Route::get('/{name}', 'UserController@profile');
