<?php

class Account_Controller extends Controller {
	
	public $layout = 'layout';
	public $restful = true;

	public function __construct(){
		parent::__construct();
		$this->filter('before', 'auth');
	}

	public function get_index(){
		$this->layout->content = View::make('account.view');
	}

	public function get_modify(){
		$form = Formly::make(Auth::user());
		$this->layout->content = View::make('account.modify')->with('form', $form);
	}

	public function post_modify(){
		$user = Auth::user();

		/* Is current password valid ? */
		if(!Hash::check(Input::get('current_password'), $user->password)){
			Alert::error('Le mot de passe est incorrect.', 'invalid_pwd');
			return Redirect::back()->with_input();
		}

		$user->fill(Input::get());

		if($user->save()){
			return Redirect::to('account');
		}
		else {
			return Redirect::back()->with_input()->with_errors($user->errors);
		}
	}

	public function post_change_photo(){

		$user = Auth::user();

		$rules = array(
                'image' => User::$rules['image'].'|required',
            );

        $validation = Validator::make(Input::file(), $rules);

		if($validation->fails()){
			return Redirect::back()->with_input()->with_errors($validation);
		}

		/* Get file */
        $img = Input::file('image');

        $user->image = $img;

        if($user->save()){
			return Redirect::to('account');
		}
		else {
			return Redirect::back()->with_input()->with_errors($user->errors);
		}
	}

	public function get_change_pwd(){
		$form = new Formly();

		$this->layout->content = View::make('account.change_pwd')->with('form', $form);
	}

	public function post_change_pwd(){

		$user = Auth::user();
		
		$rules = array('password' => User::$rules['password'].'|confirmed');

		/* Is current password valid */
		if(!Hash::check(Input::get('old_password'), $user->password)){
			Alert::error('Le mot de passe actuel est incorrect.', 'invalid_pwd');
			return Redirect::back()->with_input();
		}

		$validation = Validator::make(Input::get(), $rules);

		if($validation->fails()){
			return Redirect::back()->with_input()->with_errors($validation);
		}

		$user->password = Input::get('password');

		if($user->save()){
			return Redirect::to('account');
		}
		else {
			return Redirect::back()->with_input()->with_errors($user->errors);
		}
	}
}