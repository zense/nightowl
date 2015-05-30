<?php
use Illuminate\Database\Eloquent\ModelNotFoundException;
class PageController extends BaseController {

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

	public function buildPage($code)
	{
		$user = User::getbyCode($code);
		if(!$user){
			$username = hash('crc32',$code);
			//return $id;
			$user =  User::create(array('code'=>$code, 'username'=>$username));
		}
		$posts = $user->getFeed();
    return View::make('2',$user)->with(array('posts' => $posts, 'url' => $user->getURL()));
	}
    public function store()
    {
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'username'  => 'required',
            'text'      => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('/')
                ->withErrors($validator);
        } else {
            // store
	    $code = '/u/'.Session::getId();
			$post = new Post(Input::all());
			$user = User::getbyName(Input::get('username'));
			$user->posts()->save($post);
      return Redirect::to($code)->withMessage('Done!');
        }
    }
}
