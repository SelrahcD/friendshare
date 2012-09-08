<?php

class Friends_Controller extends Controller {
	
	public $layout = 'layout';

	public $restful = true;

	public function __construct(){
		parent::__construct();
		$this->filter('before', 'auth');
	}

	public function get_index(){
		$user = Auth::user();

		$form = new Formly();

		$friends = $user->friends()->with('debt')->paginate(10);
		$this->layout->content = View::make('friends.list')->with('friends', $friends)->with('form', $form);
	}

	public function get_v($userId){

		$user = Auth::User();

		$friend = $user->friends()->where('user_id', '=', $userId)->with('debt')->first();
		if(!$friend){
			return Redirect::error(404);
		}

		$this->layout->content = View::make('friends.view')->with('friend', $friend);
	}

	public function get_search(){
		return Redirect::to('friends');
	}
	
	public function post_search(){

		if(!Input::has('friend_data')){
			return Redirect::to('friends');
		}

		/* Cut query in words*/
		$data = preg_split('/[\s]/', Input::get('friend_data'));

		/* Build request */
		$result = User::query();
		$first = true;
		foreach($data as $word){
			if($first){
				$first = false;
				$result->where('firstname', 'LIKE', '%'.$word.'%')->or_where('lastname', 'LIKE', '%'.$word.'%');
				continue;
			}

			$result->or_where('firstname', 'LIKE', '%'.$word.'%')->or_where('lastname', 'LIKE', '%'.$word.'%');
		}

		/* Paginate result */
		$result = $result->distinct()->paginate(10);

		/* Add result to view */
		$this->layout->content = View::make('friends.search_result')->with('people', $result);
	}
}