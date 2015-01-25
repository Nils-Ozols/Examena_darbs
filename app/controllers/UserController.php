<?php

class UserController extends BaseController {
    
    public function getRegister()
    {
        return View::make('register');
    }
    
    public function postRegister()
    {
        $data = Input::all();
        
        $rules = $rules = array(
            'username' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5|confirmed',
        );
        
        $validator = Validator::make($data, $rules);
        
        if ($validator->passes())
        {
            $user = new User();
            
            $user->username = $data['username'];
            $user->email = $data['email'];
            $user->password = Hash::make($data['password']);
            
            $user->save();
            
            Auth::login($user);
            
            return Redirect::to('user')->withMessage('Successfully registered!');
        }
        
        return Redirect::to('user/register')->withErrors($validator);
    }
    
    public function getLogin()
    {
        return View::make('login');
    }
    
    public function postLogin()
    {
        if (!empty(Input::get('remember')))
        {
            $remember_auth = true;
        } else {
            $remember_auth = false;
        }

        if (Auth::attempt(array('username' => Input::get('username'), 'password' => Input::get('password')), $remember_auth))
        {
			if (Input::get('redirect')) return Redirect::to(Input::get('redirect'))->withMessage('Successfully logged in!');
            return Redirect::to('user')->withMessage('Successfully logged in!');
        }
		
        return Redirect::to('user/login')->withErrors(array('loginfailed' => 'Incorrect username and/or password!'));
    }
    
    public function getLogout()
    {
        Auth::logout();
        return Redirect::to('/');
    }
    
    // this handles requests to prefix itself, in this case /user
    public function getIndex($id = 0)
    {
        $user = User::find($id);
		if (!$user) {
			if (Auth::guest()) {
				return Redirect::to('user/login');
			} 
			$user = User::find(Auth::id());
		}
		
		if (Auth::id() != $user->id && !Auth::user()->isAdmin()) {
			$galleries = $user->galleries()->where('public', '>', 0)->get();
		} else {
			$galleries = $user->galleries()->get();
		}
		
        return View::make('user', array('user' => $user, 'galleries' => $galleries));
    }
  

}

?>