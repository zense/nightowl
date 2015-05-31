<?php
use Illuminate\Database\Eloquent\ModelNotFoundException;
class RestController extends BaseController {

    /*
    |--------------------------------------------------------------------------
    | Default Home Controller
    |--------------------------------------------------------------------------
    |
    | You may wish to use controllers instead of, or in addition to, Closure
    | based routes. That's great! Here is an eLifehacker
30 mins ·

Keep those extension cords from getting tangled.xample controller method to
    | get you started. To route to this controller, just add the route:
    |
    |	Route::get('/', 'HomeController@showWelcome');
    |
    */
    public function index()
    {
        return View::make('allPosts')->with('posts',Post::all());
    }


    public function getPosts($code){
        $user = User::getbyCode($code);
        if(!$user){
            $username = hash('crc32',$code);
            //return $id;
            $user =  User::create(array('code'=>$code, 'username'=>$username));
        }
        $posts = $user->getFeed();
        return json_decode($posts);
    }

}
