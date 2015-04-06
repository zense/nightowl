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


Route::get('/profile/', 'PageController@profile');
Route::resource('nerds', 'NerdController');
Route::model('user', 'User');
