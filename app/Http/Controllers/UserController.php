<?php
namespace App\Http\Controllers;

use App\User;
use App\Post;

use Session;
use View, Form;
use Validator, Request, Redirect;
class UserController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('userList')->with('users',User::all());
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit()
	{
		$user = User::getbyCode(Session::getId());
		return View::make('profileEdit',$user);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update()
	{
		// validate
		// read more on validation at http://laravel.com/docs/validation
		$rules = array(
			'email'      => 'email',
			'username'   => 'required'
		);
		$validator = Validator::make(Request::all(), $rules);

		// process the login
		if ($validator->fails()) {
			return Redirect::to('profile/edit')
				->withErrors($validator)
				->withInput(Request::all());
		} else {
			// store
			$user = User::getbyCode(Session::getId());
			$user->name       = Request::get('name');
			$user->email      = Request::get('email');
			if($user->username != Request::get('username')){
				$user->username   = Request::get('username');
			}
			$user->save();

			// redirect
			Session::flash('message', 'Successfully updated!');
			return Redirect::to('profile');
		}
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}
    public static function profile($username){
		$user = User::getByName($username);
		$posts = $user->posts;
		$following = -1;
		$currentUser = User::getbyCode(Session::getId());
		if($currentUser->id != $user->id){
			foreach($currentUser->following as $f){
				if($user->id == $f->id){
					$following = 1;
					break;
				}
			}
			if($following == -1){
				$following = 0;
			}
		}
		return View::make('profile',$user)->with('posts', $posts)->with('following',$following);
	}

	public function unfollow($username){
		$user1 = User::getbyCode(Session::getId());
		$user2 = User::getByName($username);
		if($user1 == $user2){
			return json_encode(array('status' => '-1', 'message' => 'You cannot unfollow yourself'));
		}
		else if ($user1 && $user2) {
			$user1->following()->detach($user2);
			return json_encode(array('status' => '1', 'message' => 'Unfollowed '.$user2->name));
		}
		return json_encode(array('status' => '0', 'message' => 'Error'));
	}
	public function follow($username){
		$user1 = User::getbyCode(Session::getId());
		$user2 = User::getByName($username);
		if($user1 == $user2){
			return json_encode(array('status' => '-1', 'message' => 'You cannot follow yourself'));
		}
		else if ($user1 && $user2) {
			$user1->following()->save($user2);
			return json_encode(array('status' => '1', 'message' => 'Followed '.$user2->name));
		}
		return json_encode(array('status' => '0', 'message' => 'Error'));
	}
}
