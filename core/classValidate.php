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

class Validate{
	public function __construct(){
	}

	public function name($string,$init = 4,$end = 60){
			if (preg_match('/^[a-z\d_ .áéíóúñ]{'.$init.','.$end.'}$/i', $string)) {
			    return true;
			}else{
				return false;
			}
	}
	
	public function text($string){
			if (trim($string) != "") {
			    return true;
			}else{
				return false;
			}		
	}
	
	public function email($string){
			if (preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $string)) {
			    return true;
			}else{
				return false;
			}
	}	
	
	public function ip($string){
			if (preg_match('^(?:25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)(?:[.](?:25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)){3}$', $string)) {
			    return true;
			}else{
				return false;
			}
	}	

	public function hexadecimal($string){
			if (preg_match('/^#(?:(?:[a-f\d]{3}){1,2})$/i', $string)) {
			    return true;
			}else{
				return false;
			}
	}

	public function date($string){
			if (preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $string)) {
			    return true;
			}else{
				return false;
			}
	}	
	public function phone($string){
			if (preg_match('#^\d{4}[\s\.-]?\d{4}$#', $string)) {
			    return true;
			}else{
				return false;
			}
	}
	public function cedula($string){
			if (preg_match('/^\d{1,2}[-]\d{4}[-]\d{4}$/', $string)) {
			    return true;
			}else{
				return false;
			}
	}
	public function number($string,$min = 4,$max = 4){
			if (preg_match('/^[0-9]{'.$min.','.$max.'}$/i', $string)) {
			    return true;
			}else{
				return false;
			}
	}		

}