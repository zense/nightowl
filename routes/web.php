<?php

use App\User;
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

Route::model('user', 'App\User');

Route::get('/', 'PageController@home');

Route::get('/u/{code}', 'PageController@buildPage');
Route::get('/rest/posts/', 'RestController@getPosts');
Route::match(array('GET', 'POST'),'/rest/addpost/', 'RestController@addPost');


Route::get('/profile', function(){
	$user = User::getbyCode(Session::getId());
	return redirect('/'.$user->username);
});
Route::get('/about', function(){
	return View::make('about');
});
Route::get('/blog', function(){
	return Redirect::to('http://arkokoley.github.io/');
});

Route::get('/users', 'UserController@index');
Route::get('/posts', 'PageController@index');
Route::get('/{name}', 'UserController@profile');
Route::get('/profile/edit', 'UserController@edit');
Route::post('/profile/edit', 'UserController@update');

Route::post('/', 'PageController@store');

Route::get('{username}/follow','UserController@follow');
Route::get('{username}/unfollow','UserController@unfollow');

Route::get('/upvote/{id}', 'PageController@updateUpvotes');

