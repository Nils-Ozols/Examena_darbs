<?php

class HomeController extends BaseController {

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

	public function getIndex()
	{
		if (Auth::user()->isAdmin())
			$galleries = Gallery::all();
		else
			$galleries = Gallery::where('public','>',0)->get();
		return View::make('galleries', array('galleries' => $galleries));
	}

}
