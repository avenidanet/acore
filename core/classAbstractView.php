<?php
/**
* ACore v.5.1.0
*
* Simple framework php
*
* @author Brian Salazar [Avenidanet]
* @link http://www.avenidanet.com
* @copyright Brian Salazar 2006-2013
* @license http://mit-license.org
* 
*/

abstract class AbstractView{
	/*
	 * ERROR
	 */	
	public function __call($name,$params){
		echo "ACORE(Class View): VIEW ".$name." NOT FOUND =( ";
	}
}