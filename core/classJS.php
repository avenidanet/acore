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

class JS{

	public static function script($data){
		$CDN = array(	'jquery'=>'<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>',
						'swfObject'=>'<script src="//ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js"></script>');
		return $CDN[$data];
	}
	/*
	 * ERROR
	*/
	public function __call($name,$params){
		echo "ACORE(Class Javascript): FUNCTION ".$name." NOT FOUND =( ";
	}
}