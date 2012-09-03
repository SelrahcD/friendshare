<?php

class Auth_Auth_Controller extends Controller {
	
	public $restful = true;
	public $layout = 'auth::layout';

	public function get_login(){
		/* If we are already logged in go to home */
		if(Auth::check()){
			return Redirect::home();
		}	

		/* Create formly instance*/
		$form = new Formly();

		/* Create login view and give it the form */
		$this->layout->content = View::make('auth::login')->with('form', $form);
	}

	public function post_login(){
		/* If we are already logged in go to home */
		if(Auth::check()){
			return Redirect::home();
		}	

		$credentials = array(
			'username' => Input::get('email'),
			'password' => Input::get('password')
			);

		if ( Auth::attempt($credentials) ){
			return Redirect::home();
		}
		else {
			Alert::error('Adresse email ou mot de passe incorrect.');
			return Redirect::back()->with_input();
		} 
	}

	public function get_logout(){
		Auth::logout();
		return Redirect::home();
	}

	public function get_register(){
		/* If we are already logged in go to home */
		if(Auth::check()){
			return Redirect::home();
		}	

		/* Create formly instance*/
		$form = new Formly();

		/* Create login view and give it the form */
		$this->layout->content = View::make('auth::register')->with('form', $form);
	}

	public function post_register(){
		/* If we are already logged in go to home */
		if(Auth::check()){
			return Redirect::home();
		}	
		
		/* Get rules from user model */
		$rules = User::$rules;

		/* Add confirmation to password's rules */
		$rules['password'] .= '|confirmed';

		/* Validate */
		$validator = Validator::make(Input::get(), $rules);
		if($validator->fails()){
			return Redirect::back()->with_input()->with_errors($validator);
		}

		/* Create new user */
		$user = new User;
		$user->fill(Input::all());
		$user->password = Input::get('password');

		/* Store it on DB*/
		if($user->save()){
			Alert::success('Votre compte a été créé avec succès.');
			return Redirect::home();
		}
		else return Redirect::back()->with_input()->with_errors($user->errors);
	}
}