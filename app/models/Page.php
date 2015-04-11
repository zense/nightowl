<?php

class Page extends Eloquent {
  protected $table = 'data';
  public static function saveFormData($data) {
    DB::table('data')->insert($data);
  }

  public static function get5RandomPosts($name) {
    $posts = DB::table('data')
              ->where('name','!=',$name)
              ->orderByRaw("RANDOM()")
              ->take(10)
              ->get();
    return $posts;
  }
}
