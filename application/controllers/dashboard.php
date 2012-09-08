<?php

class Dashboard_Controller extends Controller {

	public $layout = 'layout';

	public function __construct(){
		parent::__construct();
		$this->filter('before', 'auth');
	}
	
	public function action_index(){
		$user = Auth::user();

		$this->layout->content = View::make('dashboard');

		/* Add number of friends to the view */
		$friendsNumber = $user->friends()->count();
		$this->layout->content->with('friendsNumber', $friendsNumber);

		
		/* Get the five last friends user had interaction with */
		$friends = $user->friends()->order_by('updated_at', 'desc')->take(3)->get();
		$this->layout->content->with('friends', $friends);

	}
}