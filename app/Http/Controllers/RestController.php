<?php
use Illuminate\Database\Eloquent\ModelNotFoundException;
namespace App\Http\Controllers;
use App\User;
use App\Post;

use Session;
use View;
use Validator, Request, Redirect;

class RestController extends Controller {

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


    public function getPosts(){
        $code = Session::getId();
        $user = User::getbyCode($code);
        if(!$user){
            $username = hash('crc32',$code);
            //return $id;
            $user =  User::create(array('code'=>$code, 'username'=>$username));
        }
        $posts = $user->getFeed();
        return $posts;
    }

    public function addPost()
    {
        // validate
        // read more on validation at http://laravel.com/docs/validation
        /*
         * Need to change this method into post method
         * Currently it's using get method
         */
        $rules = array(
            'username'  => 'required',
            'text'      => 'required'
        );
        $validator = Validator::make(Request::all(), $rules);

        // process the login
        if ($validator->fails()) {
            $status = array('status'=>0, 'error'=>$validator);
            header('Content-Type: application/json');
            return json_encode($status);
        } else {
            // store
            $code = '/u/'.Session::getId();
            $post = new Post(Request::all());
            $user = User::getbyName(Request::get('username'));
            $user->posts()->save($post);
            $status = array('status'=>1, 'message'=>'Done');
            header('Content-Type: application/json');
            return json_encode($status);
        }
    }

}
