<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Post extends Model {
  protected $table = 'posts';
  protected $fillable = array('user', 'text');

  public static function get5RandomPosts($id) {
    return Post::where('user','!=',$id)->latest()->take(10)->get();
  }

  public static function get5RandomPostsJson($id){
    return json_encode(Post::where('user', '!=', $id)->latest()->take(10)->get());
  }

  public function author(){
    return $this->belongsTo('App\User','user','id');
  }
}
