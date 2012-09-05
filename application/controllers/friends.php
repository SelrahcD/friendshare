<?php

class Friends_Controller extends Controller {
	
	public $layout = 'layout';

	public function action_index(){
		$user = Auth::user();
		$friends = $user->friends()->with('debt')->get();
		$this->layout->content = View::make('friends.view')->with('friends', $friends);
	}
}