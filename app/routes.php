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
{	$code = '/u/';
	$code .= Session::getId();
	return Redirect::to($code);
});

Route::get('/u/{code}', 'PageController@buildPage');

Route::get('/profile', function(){
	$user = User::getbyCode(Session::getId());
	return UserController::profile($user->username);
});

Route::get('/{name}', 'UserController@profile');
Route::get('/profile/edit', 'UserController@edit');
Route::post('/profile/edit', 'UserController@update');

Route::post('/post/store', 'PageController@store');

Route::get('{username}/follow','UserController@follow');
Route::get('{username}/unfollow','UserController@unfollow');
