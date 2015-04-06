<?php
use Illuminate\Database\Eloquent\ModelNotFoundException;
class PageController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function buildPage($id)
	{	$host = $_SERVER['REMOTE_ADDR'];
		//$rules = array('id' => 'unique:users,id');
		//$validator = Validator::make(array('id'=>$id) , $rules);
		//$obj = new User;
		try {
			$user = User::findOrFail($id);
		}
//        	if ($validator->fails()) {
//			$user = $obj->where('id','=',$id)->get();
//		}
		catch(ModelNotFoundException $e){
			$name = hash('crc32',$id);
			//return $id;
			$user = User::store(array('id'=>$id, 'name'=>$name));
			$user = User::findOrFail($id);
		}
		//else{
		//	$name = hash('crc32',$id);
		//	$obj->store(array('id'=>$id, 'name'=>$name));
		//	$user = $obj->where('id','=',$id)->get();
		//}
		$posts = Page::get5RandomPosts($user->name);
    		return View::make('2')->with('id', $user->id)->with('name',$user->name)->with('posts',$posts)->with('host', $host);
	}
    public function store()
    {
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'name'       => 'required',
            'code'      => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('/')
                ->withErrors($validator);
        } else {
            // store
	    $id = '/u/'.Session::getId();
	    Page::saveFormData(Input::except(array('_token')));
            return Redirect::to($id)->withMessage('Done!');
        }
    }
    public function profile($name){
	//$id = Session::getId();
	$user = User::getByName($name);
	$posts = $user->allPosts($user->id);
	return View::make('profile')->with(array('posts'=>$posts,'id'=>$user->id, 'name'=>$user->name));
	}
}
