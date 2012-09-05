<?php

class Dashboard_Controller extends Controller {

	public $layout = 'layout';

	public function __construct(){
		parent::__construct();
		$this->filter('before', 'auth');
	}
	
	public function action_index(){
		$this->layout->content = View::make('dashboard');
	}
}