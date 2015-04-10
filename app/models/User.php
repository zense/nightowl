<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');
	protected $fillable = array('id','name');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */

	public static function getbyName($name)
	{
		return User::where('name','=',$name)->first();
	}

	public static function store($data) {
		DB::table('users')->insert($data);
	}

	public static function allPosts($id){
		$user = User::find($id);
		$posts = DB::table('data')
			->where('name','=',$user->name)
			->get();
		return $posts;
	}
	public static function getURL($id){
		return URL::to('/u/'.$id);

	}
}