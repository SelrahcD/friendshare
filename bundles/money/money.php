<?php

class Money {
	
	private static $absolute = true;

	private static $separator = ".";

	private static $decimals = 2;

	private static $thousand_separator = ' ';

	private static $currency = '€';

	private static $currency_position = 'middle';

	private static $format;

	private static $instance = null;

	private function __construct(){
		static::$format = array(
		'after' => '%1$d' . static::$separator . '%2$d%3$s',
		'middle' => '%1$d%3$s%2$d',
		'before' => '%3$s %1$d'.static::$separator.'%2$d'
		);
	}

	public static function render($value, $options= array()){

		if(!static::$instance){
			static::$instance = new Money();
		}

		if(static::$absolute){
			$value = abs($value);
		}

		$value = number_format($value, static::$decimals, '.', static::$thousand_separator);
		list($int, $dec) = sscanf($value, "%d.%d");

		return sprintf( static::$format[static::$currency_position], $int, $dec, static::$currency);
	}
}