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

class Url{
	
	public $ch;
	
	public function getUrl($url,$type=NULL,$paramsPOST = array(),$paramsGET = array()){
		
		$ch = curl_init();
		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		if(!empty($paramsPOST)){
			$fields_string = http_build_query($paramsPOST);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
		}
		if(!empty($paramsGET)){
			$fields_string = http_build_query($paramsGET);
			$url .= "?".$fields_string;
		}
		curl_setopt($ch, CURLOPT_URL, $url);
		
		$output = curl_exec($ch);
		$info = curl_getinfo($ch);
		curl_close($ch);
		
		$result['output'] = $output;
		$result['info'] = $info;
		
		if($type == "XML"){
			$result['parse'] = new SimpleXMLElement($output); 
		}elseif ($type == "JSON") {
			$result['parse'] = json_decode($output);	
		}else{
			$result['parse'] = $output;
		}	
		return $result;
	}
	/*
	 * ERROR
	 */    
	public function __call($name,$params){
		echo "ACORE(Class URL): METHOD ".$name." NOT FOUND =( ";
	}	
}