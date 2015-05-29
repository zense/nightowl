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
	protected $fillable = array('code','username','name','email');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */

	public static function getbyName($username)
	{
		return User::where('username','=',$username)->first();
	}

	public static function store($data) {
		DB::table('users')->insert($data);
	}

	public function posts(){
		return $this->hasMany('Post', 'user','id');
	}
	public static function getbyCode($code){
		return User::where('code','=',$code)->first();
	}

	public function getURL(){
		return URL::to('/u/'.$this->code);
	}
	public function followers(){
	    return $this->belongsToMany('User', 'followers', 'follow_id', 'user_id')->withTimestamps();
	}

	// Get all users we are following
	public function following(){
	    return $this->belongsToMany('User', 'followers', 'user_id', 'follow_id')->withTimestamps();
	}

	public function getFeed()
  {
    $userIds = $this->following()->lists('follow_id');
    $userIds[] = $this->id;
		$posts = Post::whereIn('user', $userIds)->latest()->get();
		$RandomPosts = Post::whereNotIn('user',$userIds)->take(10)->get();
		return $posts->merge($RandomPosts);
	}
}
