<?php
/**
* ACore v.5.0.0
*
* Simple framework php
*
* @author Brian Salazar [Avenidanet]
* @link http://www.avenidanet.com
* @copyright Brian Salazar 2006-2013
* @license http://mit-license.org
* 
*/

class D{
	
	public static function log($data){
		echo "<pre>";
		print_r($data);
		echo "</pre>";
	}
	
	public static function fancy($data){
		$css = "<style>#ac_debug{-webkit-border-radius: 10px;-moz-border-radius: 10px;border-radius: 10px;-moz-box-shadow: 10px 10px 5px #888;-webkit-box-shadow: 10px 10px 5px #888;box-shadow: 10px 10px 5px #888; position:absolute; padding: 10px; top: 10px; left:10px; border: 1px solid #333; color: #666; background: #eee}</style>";
		echo $css."<div id='ac_debug'><pre>";
		print_r($data);
		echo "</pre></div>";
	}	
	/*
	 * ERROR
	 */    
	public function __call($name,$params){
		echo "ACORE(Class Debug): FUNCTION ".$name." NOT FOUND =( ";
	}	
}