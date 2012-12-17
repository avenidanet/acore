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
	/*
	 * ERROR
	 */    
	public function __call($name,$params){
		echo "ACORE(Class Debug): FUNCTION ".$name." NOT FOUND =( ";
	}	
}