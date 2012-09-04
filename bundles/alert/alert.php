<?php

class Alert {

	private static $alerts = array();

	public static function success($text){

		return static::addAlert($text, 'success');
	}

	public static function error($text){

		return static::addAlert($text, 'error');
	}

	public static function warning($text){

		return static::addAlert($text, 'warning');
	}

	private static function addAlert($text, $type = null){
		static::$alerts[] = array(
			'type' => $type,
			'text' => $text );

		static::toSession();
	}

	private static function toSession(){
		Session::flash('alerts', static::$alerts);
	}

	public static function render(){
		$alerts = Session::get('alerts');
		$res = '';
		if($alerts){
			$res = '<div class="alert-container">'."\n";
			foreach($alerts as $alert){
				$res .= '<p class="alert-'.$alert['type'].'">'.$alert['text'].'</p>'."\n";
			}
			$res .= '</div>'. "\n";
		}

		return $res;
	}

	public static function has_alerts(){
		return Session::has('alerts');
	}


}