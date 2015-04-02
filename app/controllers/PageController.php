<?php

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
		$posts = Page::get5RandomPosts();
		$rules = array('id' => 'unique:users,id');
		$validator = Validator::make(array('id'=>$id) , $rules);
		$obj = new User;

        	if ($validator->fails()) {
			$user = $obj->where('id','=',$id)->get();
		}
		else{
			$name = hash('crc32',$id);
			$obj->store(array('id'=>$id, 'name'=>$name));
			$user = $obj->where('id','=',$id)->get();
		}
    		return View::make('page')->with('id', $user[0]->id)->with('name',$user['0']->name)->with('posts',$posts)->with('host', $host);
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


}
