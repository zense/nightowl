<?php

class Page extends Eloquent {
  protected $table = 'data';
  public static function saveFormData($data) {
    DB::table('data')->insert($data);
  }

  public static function get5RandomPosts() {
    $posts = DB::table('data')
              ->orderByRaw("RAND()")
              ->take(5)
              ->get();
    return $posts;
  }
}
