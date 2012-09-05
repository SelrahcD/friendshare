<?php

class Alert {

	private static $alerts = array();

	public static function success($text, $area = null){

		return static::addAlert($text, 'success', $area);
	}

	public static function error($text, $area = null){

		return static::addAlert($text, 'error', $area);
	}

	public static function warning($text, $area = null){

		return static::addAlert($text, 'warning', $area);
	}

	private static function addAlert($text, $type = 'normal', $area = null){
		static::$alerts[] = array(
			'type' => $type,
			'text' => $text,
			'area' => $area );

		static::toSession();
	}

	private static function toSession(){
		Session::flash('alerts', static::$alerts);
	}

	public static function render($area = null){
		$alerts = Session::get('alerts', array());

		$alertsToDisplay = array();
		foreach($alerts as $alert){
			if($alert['area'] == $area){
				$alertsToDisplay[] = $alert;
			}
		}


		$res = '';
		if(sizeof($alertsToDisplay)){
			$res = '<div class="alert-container">'."\n";
			foreach($alertsToDisplay as $alert){
				$res .= '<p class="alert-'.$alert['type'].'">'.$alert['text'].'</p>'."\n";
			}
			$res .= '</div>'. "\n";
		}

		return $res;
	}

	public static function has_alerts($area = null){
		$alerts = Session::get('alerts', array());

		$alertsForArea = array();
		foreach($alerts as $alert){
			if($alert['area'] == $area){
				$alertsForArea[] = $alert;
			}
		}
		
		return sizeof($alertsForArea);
	}


}