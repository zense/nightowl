<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use URL;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code','username','name','email',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [ 'remember_token' ];

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
  		return $this->hasMany('App\Post', 'user','id');
  	}
  	public static function getbyCode($code){
  		return User::where('code','=',$code)->first();
  	}

  	public function getURL(){
  		return URL::to('/u/'.$this->code);
  	}
  	public function followers(){
  	    return $this->belongsToMany('App\User', 'followers', 'follow_id', 'user_id')->withTimestamps();
  	}

  	// Get all users we are following
  	public function following(){
  	    return $this->belongsToMany('App\User', 'followers', 'user_id', 'follow_id')->withTimestamps();
  	}

  	public function getFeed()
    {
      $userIds = $this->following()->pluck('follow_id');
      $userIds[] = $this->id;
  		$posts = Post::whereIn('user', $userIds)->latest()->take(20)->get();
  		$RandomPosts = Post::whereNotIn('user',$userIds)->latest()->take(10)->get();
  		return $posts->merge($RandomPosts);
  	}
}
