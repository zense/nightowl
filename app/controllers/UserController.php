<?php

class UserController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
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
		$validator = Validator::make(Input::all(), $rules);

		// process the login
		if ($validator->fails()) {
			return Redirect::to('profile/edit')
				->withErrors($validator)
				->withInput(Input::all());
		} else {
			// store
			$user = User::getbyCode(Session::getId());
			$user->name       = Input::get('name');
			$user->email      = Input::get('email');
			if($user->username != Input::get('username')){
				foreach($user->posts as $post){
					$post->username = Input::get('username');
					$post->save();
				}
				$user->username   = Input::get('username');
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
			$following = ($following==-1)? 0:1;
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
			$user1->following()->save($user2);
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
			$user1->following()->detach($user2);
			return json_encode(array('status' => '1', 'message' => 'Followed '.$user2->name));
		}
		return json_encode(array('status' => '0', 'message' => 'Error'));
	}
}
